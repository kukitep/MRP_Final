<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {
	
    public function get($id = null)
    {
        $this->db->from('p_unit');
        if($id != null){
            $this->db->where('unit_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
	{
        $this->db->where('unit_id' , $id);
		$this->db->delete('p_unit');
	}

    public function add($post)
    {
        $params = [
            'name' => $post['unit_name'],
            'created' => date('Y-m-d H:i:s'),
            'status' => $post['status']
        ];
        $this->db->insert('p_unit',$params);
    }
    
    public function edit($post)
    {
        $params = [
            'name' => $post['unit_name'],
            'updated' => date('Y-m-d H:i:s'),
            'status' => $post['status']
        ];
        $this->db->where('unit_id' , $post['unit_id']);
        $this->db->update('p_unit',$params);

    }

  

    }

