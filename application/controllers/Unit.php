<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('unit_model');
	}

	public function index()
	{
		$data['row'] = $this->unit_model->get();
		$this->template->load('template' , 'produk/unit/unit_data',$data);
		
	}
	
	public function delete($id)
	{
        $this->unit_model->delete($id);
		if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success','Data Successfuly Deleted');															
		}
		redirect('unit');
	}
	
	public function add()
	{
		$unit = new stdClass();
		$unit->unit_id = null;
		$unit->name = null;
		$unit->level = null;	
		$data = array(
			'page' => 'add',
			'row' => $unit

		);
		$this->template->load('template' , 'produk/unit/unit_form',$data);					
		
	}

	public function process()
	{

		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])){
			$this->unit_model->add($post);
		} else if(isset($_POST['edit'])){
			$this->unit_model->edit($post);
		}

		if($this->db->affected_rows() > 0){
            if(isset($_POST['add'])){
			$this->session->set_flashdata('success','Data Successfuly Added');
            } else if(isset($_POST['edit'])){           
            $this->session->set_flashdata('success','Data Successfuly Saved');
            }				
		}
		redirect('unit');
		
	}
	
	public function edit($id)
	{
		$query = $this->unit_model->get($id);
		if($query->num_rows() > 0) {
			$unit = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $unit
	
			);
			$this->template->load('template' , 'produk/unit/unit_form',$data);
			
		} else {
			echo "<script>
							alert('Data Not Found');";	
					echo "window.location='".base_url('unit')."';
						</script>";	
		}
	}
}
