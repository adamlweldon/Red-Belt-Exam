<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_catalog extends CI_Controller 
{ 
	public function __construct() 
	{
		parent::__construct();
	}
	public function index() 
	{
		redirect(base_url('/product_catalog/admin'));
	}
	public function admin()
	{	
		$product = new Product();
		$products = $product->load_products();
		$data['products'] = $products;
		$this->load->view('admin', $data);
	}
	public function add_function() 
	{
		$product = new Product();
		$product->add_product($this->input->post()); 
		$new_product = $product->load_products($this->input->post());
		$new_product = array(
				'id' => $new_product->id,
				'name' => $new_product->name,
				'category' => $new_product->category,
				'description' => $new_product->description
		);
		$data['product_info'] = $new_product;
		echo json_encode($data);
	}
	public function delete_function() 
	{
		$product = new Product();
		$data['id'] = $this->input->post('id');
		if($product->delete_product($this->input->post()))
		{
			$data['result']='success';
		}
		else
		{
			$data['result']='fail';
		}
		echo json_encode($data);
	}
}
/* end of file */