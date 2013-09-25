<?php

class Product extends DataMapper 
{
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
    function add_product($product_info)
    {
        $this->name = $product_info['name'];
        $this->category = $product_info['category'];
        $this->description = $product_info['description'];
        $this->save();
    }
    function delete_product($product_info) {
        $this->where('id', $product_info['id'])->get();
        $this->delete();
    } 
    function load_products($product_info='')
    {
        if($product_info!=NULL)
        {
            $this->where('name', $product_info['name']);
            $this->where('category', $product_info['category']);
            $this->where('description', $product_info['description']);
            return $this->get();
        }
        else
        {
            return $this->get();
        }
    }
    var $created_field = 'created_at';
    var $updated_field = 'updated_at';
}
/* End of file*/