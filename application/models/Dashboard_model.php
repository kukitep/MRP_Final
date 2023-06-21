<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_model extends CI_Model {
	
    public function get($id = null)
    {
        $this->db->select('p_manufacture.*, bom_header.name as bname , bom_header.bom_no as bno , p_item.name as pname');
        $this->db->from('p_manufacture');
        $this->db->join('bom_header' , 'bom_header.header_id = p_manufacture.header_id');
        $this->db->join('p_item' , 'bom_header.item_id = p_item.item_id');

        if($id != null){
            $this->db->where('manufacture_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_pending($id = null)
    {
        $this->db->select('p_manufacture.status as count');
        $this->db->from('p_manufacture'); 
        $this->db->where('p_manufacture.status' , '1');  
        if($id != null){              
            $this->db->where('manufacture_id' , $id);                               
                                  
        }
            
        $query = $this->db->get();
        $query= $query->num_rows();
        return $query;  
    }
    public function get_finish($id = null)
    {
        $this->db->select('p_manufacture.status as count');
        $this->db->from('p_manufacture'); 
        $this->db->where('p_manufacture.status' , '3');  
        if($id != null){              
            $this->db->where('manufacture_id' , $id);                               
                                  
        }
            
        $query = $this->db->get();
        $query= $query->num_rows();
        return $query;  
    }
    public function get_inprog($id = null)
    {
        $this->db->select('p_manufacture.status as count');
        $this->db->from('p_manufacture'); 
        $this->db->where('p_manufacture.status' , '2');  
        if($id != null){              
            $this->db->where('manufacture_id' , $id);                               
                                  
        }
            
        $query = $this->db->get();
        $query= $query->num_rows();
        return $query;     
    }
    public function get_cancel($id = null)
    {
        $this->db->select('p_manufacture.status as count');
        $this->db->from('p_manufacture'); 
        $this->db->where('p_manufacture.status' , '4');  
        if($id != null){              
            $this->db->where('manufacture_id' , $id);                               
                                  
        }
            
        $query = $this->db->get();
        $query= $query->num_rows();
        return $query;    
    }
    public function get_raw($id = null)
    {
        $this->db->select('p_manufacture.*, p_category.name as cname , p_unit.name as uname');
        $this->db->from('p_manufacture'); 
        $this->db->where('p_manufacture.category_id' , '6');  
        $this->db->join('p_category' , 'p_category.category_id = p_manufacture.category_id');
        $this->db->join('p_unit' , 'p_unit.unit_id = p_manufacture.unit_id');
         
        if($id != null){              
            $this->db->where('manufacture_id' , $id);                               
                                  
        }
            
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
	{
        $this->db->where('manufacture_id' , $id);
		$this->db->delete('p_manufacture');
	}

    public function add($post)
    {
        $params = [
            'manufacture_no' => $post['manufacture_no'],    
            'header_id' => $post['header'],
            'created' => date('Y-m-d H:i:s'),
            'scheduled' => $post['scheduled'],
            'description' => $post['deskripsi'],
            'status' => $post['status']
        ]; 
        $this->db->insert('p_manufacture',$params);
    }
    
    public function edit($post)
    {
        $params = [
            'manufacture_no' => $post['manufacture_no'],    
            'header_id' => $post['header'],
            'updated' => date('Y-m-d H:i:s'),
            'scheduled' => $post['scheduled'],
            'description' => empty($post['desc']) ? null : $post['deskripsi'],
            'status' => $post['status']
        ];
        $this->db->where('manufacture_id' , $post['manufacture_id']);
        $this->db->update('p_manufacture',$params);

    }

    

    }

