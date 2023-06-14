<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
	
    public function get($id = null)
    {
       
        $this->db->from('p_category');
        
        if($id != null){
            $this->db->where('category_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_active($id = null)
    { 
        $this->db->select('p_category.*');
        $this->db->from('p_category');
        $this->db->where('p_category.status' , '1');
        if($id != null){
            $this->db->where('category_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
	{
        $this->db->where('category_id' , $id);
		$this->db->delete('p_category');
	}

    public function add($post)
    {
        $params = [
            'name' => $post['category_name'],
            'created' => date('Y-m-d H:i:s'),
            'status' => $post['status']
        ];
        $this->db->insert('p_category',$params);
    }
    
    public function edit($post)
    {
        $params = [
            'name' => $post['category_name'],
            'updated' => date('Y-m-d H:i:s'),
            'status' => $post['status']
        ];
        $this->db->where('category_id' , $post['category_id']);
        $this->db->update('p_category',$params);

    }

  

    }

