<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {
	
    public function get($id = null)
    {
        $this->db->select('p_item.*, p_category.name as cname');
        $this->db->from('p_item');
        $this->db->join('p_category' , 'p_category.category_id = p_item.category_id');
        if($id != null){
            $this->db->where('item_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_fp($id = null)
    {
        $this->db->select('p_item.*, p_category.name as cname');
        $this->db->from('p_item'); 
        $this->db->where('p_item.category_id' , '12');  
        $this->db->where('p_item.status' , '1');  
        $this->db->join('p_category' , 'p_category.category_id = p_item.category_id');
         
        if($id != null){              
            $this->db->where('item_id' , $id);                               
                                  
        }
            
        $query = $this->db->get();
        return $query;
    }
    public function get_raw($id = null)
    {
        $this->db->select('p_item.*, p_category.name as cname');
        $this->db->from('p_item'); 
        $this->db->where('p_item.category_id' , '6');  
        $this->db->join('p_category' , 'p_category.category_id = p_item.category_id');
         
        if($id != null){              
            $this->db->where('item_id' , $id);                               
                                  
        }
            
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
	{
        $this->db->where('item_id' , $id);
		$this->db->delete('p_item');
	}

    public function add($post)
    {
        $params = [
            'name' => $post['product_name'],    
            'category_id' => $post['category'],
            'created' => date('Y-m-d H:i:s'),
            'status' =>$post['status']
        ];
        $this->db->insert('p_item',$params);
    }
    
    public function edit($post)
    {
        $params = [
            'name' => $post['product_name'],
            'category_id' => $post['category'],
            'created' => date('Y-m-d H:i:s'),
            'status' =>$post['status']
        ];
        $this->db->where('item_id' , $post['item_id']);
        $this->db->update('p_item',$params);

    }

  

    }

