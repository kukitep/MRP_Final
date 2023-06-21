<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bom_model extends CI_Model {
	
    public function get($id = null)
    {
        $this->db->select('bom_header.*, p_item.name as pname');
        $this->db->from('bom_header');
        $this->db->join('p_item' , 'p_item.item_id = bom_header.item_id');
        
        if($id != null){
            $this->db->where('header_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_active($id = null)
    {
        $this->db->select('bom_header.*, p_item.name as pname');
        $this->db->from('bom_header');
        $this->db->where('bom_header.status' , '1');
        $this->db->join('p_item' , 'p_item.item_id = bom_header.item_id');
        
        if($id != null){
            $this->db->where('header_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }
    public function getcomponent($id = null)
    {
        $this->db->select('bom_components.*, p_item.name as pname , bom_header.header_id as headid , p_unit.name as uname');
        $this->db->from('bom_components');
        $this->db->join('p_item' , 'p_item.item_id = bom_components.item_id');
        $this->db->join('bom_header' , 'bom_header.header_id = bom_components.header_id');
        $this->db->join('p_unit' , 'p_unit.unit_id = bom_components.unit_id');
        if($id != null){
            $this->db->where('bom_components.header_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }
    public function getcomponent2($id = null)
    {
        $this->db->select('bom_components.*, p_item.name as pname , bom_header.header_id as headid , p_unit.name as uname');
        $this->db->from('bom_components');
        $this->db->join('p_item' , 'p_item.item_id = bom_components.item_id');
        $this->db->join('bom_header' , 'bom_header.header_id = bom_components.header_id');
        $this->db->join('p_unit' , 'p_unit.unit_id = bom_components.unit_id');
        if($id != null){
            $this->db->where('bom_components.header_id' , $id);           
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
	{
        $this->db->where('header_id' , $id);
		$this->db->delete('bom_header');
	}
    public function deletecomp($id)
	{
        $this->db->where('component_id' , $id);
		$this->db->delete('bom_components');
	}

    public function add($post)
    {
        
        $params = [
            'bom_no' => $post['bom_no'],
            'name' => $post['bom_name'],
            'item_id' => $post['item'],
            'description' => $post['deskripsi'],
            'status' => $post['status'],
            'qty' => $post['qty']
        ];
        $this->db->insert('bom_header',$params);
    }
    public function addcom($post)
    {
        $params = [
            'header_id' => $post['bom_id'],
            'item_id' => $post['raw'],
            'quantity' => $post['quantity'],
            'unit_id' => $post['unit'],
            
        ];
        $this->db->insert('bom_components',$params);

    }
    
    public function edit($post)
    {
        $params = [
            'bom_no' => $post['bom_no'],
            'name' => $post['bom_name'],
            'item_id' => $post['item'],
            'description' => $post['deskripsi'],
            'status' => $post['status'],
            'qty'=> $post['qty']
        ];
        $this->db->where('header_id' , $post['bom_id']);
        $this->db->update('bom_header',$params);

    }
    public function getstock($id = NULL)
    {
       $this->db->from('p_item');
       if($id != null){
        $this->db->where('item_id' , $id);
       }
       $query = $this->db->get();
       return $query;
    }
    public function delcomp($post)
    {
        $params = [
            'bom_no' => $post['bom_no'],
            'name' => $post['bom_name'],
            'item_id' => $post['item'],
            'description' => $post['deskripsi'],
            'status' => $post['status'],
            'qty'=> $post['qty']
        ];
        $this->db->where('header_id' , $post['bom_id']);
        $this->db->update('bom_header',$params);

    }

  

    }

