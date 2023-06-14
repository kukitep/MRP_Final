<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['item_model' , 'category_model' , 'unit_model']);

	}

	public function index()
	{
		$data['row'] = $this->item_model->get();
		$this->template->load('template' , 'produk/item/item_data',$data);
		
	}
	
	public function delete($id)
	{
        $this->item_model->delete($id);
		if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success','Data Successfuly Deleted');															
		}
		redirect('item');
	}
	
	public function add()
	{
		$item = new stdClass();
		$item->item_id = null;
		$item->name = null;
		$item->stock = null;
		$item->level = null;

		$query_category = $this->category_model->get_active();
		$query_unit = $this->unit_model->get();

		$unit[null] = '- Choose Unit Type -';
		foreach($query_unit->result() as $unt) {
			$unit[$unt->unit_id] = $unt->name;
;		}
		$category[null] = '- Choose Category Type -';
		foreach($query_category->result() as $ctg) {
			$category[$ctg->category_id] = $ctg->name;
;		}

		$data = array(
			'page' => 'add',
			'row' => $item,
			'category' => $category,
			'unit' => $unit , 'selectedunit' => null,
			'category' => $category , 'selectedcategory' => null

		);
		$this->template->load('template' , 'produk/item/item_form',$data);					
		
	}

	public function process()
	{

		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])){
			$this->item_model->add($post);
		} else if(isset($_POST['edit'])){
			$this->item_model->edit($post);
		}

		if($this->db->affected_rows() > 0){
            if(isset($_POST['add'])){
			$this->session->set_flashdata('success','Data Successfuly Added');
            } else if(isset($_POST['edit'])){           
            $this->session->set_flashdata('success','Data Successfuly Saved');
            }				
		}
		redirect('item');
		
	}
	
	public function edit($id)
	{
		$query = $this->item_model->get($id);
	
		if($query->num_rows() > 0) {
			$item = $query->row();
			$query_category = $this->category_model->get();
			$query_unit = $this->unit_model->get();

			$unit[null] = '- Choose Unity Type -';
			foreach($query_unit->result() as $unt) {
				$unit[$unt->unit_id] = $unt->name;
			}
			$category[null] = '- Choose Category Type -';
			foreach($query_category->result() as $ctg) {
				$category[$ctg->category_id] = $ctg->name;
			}
			$data = array(
				'page' => 'edit',
				'row' => $item,
				'category' => $category,'selectedcategory' => $item->category_id,
				
				
	
			);
			$this->template->load('template' , 'produk/item/item_form',$data);
			
		} else {
			echo "<script>
							alert('Data Not Found');";	
					echo "window.location='".base_url('item')."';
						</script>";	
		}
		
	}
}
