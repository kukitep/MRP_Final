<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('category_model');
	}

	public function index()
	{
		$data['row'] = $this->category_model->get();
		$this->template->load('template' , 'produk/category/category_data',$data);
		
	}
	
	public function delete($id)
	{
        $this->category_model->delete($id);
		if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success','Data Successfuly Deleted');															
		}
		redirect('category');
	}
	
	public function add()
	{
		$category = new stdClass();
		$category->category_id = null;
		$category->name = null;
		$category->level = null;
		$data = array(
			'page' => 'add',
			'row' => $category

		);
		$this->template->load('template' , 'produk/category/category_form',$data);					
		
	}

	public function process()
	{

		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])){
			$this->category_model->add($post);
		} else if(isset($_POST['edit'])){
			$this->category_model->edit($post);
		}

		if($this->db->affected_rows() > 0){
            if(isset($_POST['add'])){
			$this->session->set_flashdata('success','Data Successfuly Added');
            } else if(isset($_POST['edit'])){           
            $this->session->set_flashdata('success','Data Successfuly Saved');
            }				
		}
		redirect('category');
		
	}
	
	public function edit($id)
	{
		$query = $this->category_model->get($id);
		if($query->num_rows() > 0) {
			$category = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $category
	
			);
			$this->template->load('template' , 'produk/category/category_form',$data);
			
		} else {
			echo "<script>
							alert('Data Not Found');";	
					echo "window.location='".base_url('category')."';
						</script>";	
		}
	}
}
