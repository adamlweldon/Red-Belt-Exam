<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Product Catalog Page</title>
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
		<script>
			$(document).ready(function(){
				$('#add_product_area').submit(function(){
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							html='	<tr><td>'+data.product_info["name"]+'</td><td>'+data.product_info["category"]+'</td><td>'+data.product_info["description"]+'</td><td><button class="delete_button" id="'+data.product_info["id"]+'" type="submit">Delete</button></td></tr>';
							$('tbody').append(html);
							$('#product_name').val('');
							$('#product_category').val('gadgets');
							$('#description_area').val( '');
							$('.delete_button').on('click', function(){
								$('#product_id').attr('value', $(this).attr('id'));
								$('#del_form').submit();
							});
						},
						"json"
					);
					return false;
				});
				$('#del_form').submit(function(){
					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							if (data.result)
							{
								$(('#'+data.id+'')).parent().parent().hide();						
							}
							else
							{
								alert('Delete Failure');
							}
						},
						"json"
					);
					return false;
				});
				$('.delete_button').on('click', function(){
					$('#product_id').attr('value', $(this).attr('id'));
				});
			});
		</script>
	</head>
	<body>
		<div id="container">
			<h2>Add New Product:</h2>
<?php 
			$errors = $this->session->flashdata('errors');
			if ($errors) {
				echo 	"<div class='alert-warning'>
							$errors
						</div>";
			}
?>
			<div class="border_top">
				<?php echo form_open('/product_catalog/add_function', array('id'=> 'add_product_area')); ?>
					Product Name: <input type="text" name="name" id='product_name'/><br/><br/>
					Category: 
					<select id='product_category' name="category">
						<option value="Cars">Cars</option>
						<option value="Gadgets">Gadgets</option>
						<option value="Home &amp Living">Home &amp Living</option>
						<option value="Outdoors">Outdoors</option>
					</select><br/><br/>
					Description: <textarea id='description_area' name="description"></textarea><br/><br/>
					<button class="add_button" type="submit">Add</button>
				</form>
			</div>
			<div class="product_table">
<?php 
	 			echo form_open('/product_catalog/delete_function', array('id' => 'del_form'));
	 		  	echo "<input type='hidden' id='product_id' name='id' value=''/>";
?>
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Category</th>
								<th>Description</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
<?php  
							foreach ($products as $product) {
								echo "<tr>
									<td>$product->name</td>
									<td>$product->category</td>
									<td>$product->description</td>
									<td><button class='delete_button' id='$product->id' type='submit'>Delete</button></td>
								</tr>";
							}
?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>