<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {
	
    public function get($id = null)
    {
        $this->db->from('produk');
        if($id != null){
            $this->db->where('product_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
	{
        $this->db->where('product_id' , $id);
		$this->db->delete('produk');
	}

    public function add($post)
    {
        $params = [
            'name' => $post['produk_name'],
            'category' => $post['category']
        ];
        $this->db->insert('produk',$params);
    }
    
    public function edit($post)
    {
        $params = [
            'name' => $post['produk_name'],
            'category' => $post['category']
        ];
        $this->db->where('product_id' , $post['product_id']);
        $this->db->update('produk',$params);

    }

    }


