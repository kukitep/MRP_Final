<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('Produk_model');
	}

	public function index()
	{
		$data['row'] = $this->Produk_model->get();
		$this->template->load('template' , 'produk/produk_data',$data);
		
	}
	
	public function delete($id)
	{
		$this->Produk_model->delete($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
			alert('Data Successfully Deleted');
			</script>";							
		}
		echo "<script>
		window.location='".base_url('produk')."';
		</script>";	
	}
	
	public function add()
	{
		$produk = new stdClass();
		$produk->product_id = null;
		$produk->name = null;
		$produk->category = null;
		$data = array(
			'page' => 'add',
			'row' => $produk

		);
		$this->template->load('template' , 'produk/produk_form',$data);
		
	}

	public function process()
	{

		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])){
			$this->Produk_model->add($post);
		} else if(isset($_POST['edit'])){
			$this->Produk_model->edit($post);
		}

		if($this->db->affected_rows() > 0){
			echo "<script>
			alert('Data Successfully Updated');
			</script>";							
		}
		echo "<script>
						window.location='".base_url('produk')."';
						</script>";	
		
	}
	
	public function edit($id)
	{
		$query = $this->Produk_model->get($id);
		if($query->num_rows() > 0) {
			$produk = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $produk
	
			);
			$this->template->load('template' , 'produk/produk_form',$data);
			
		} else {
			echo "<script>
							alert('Data Not Found');";	
					echo "window.location='".base_url('produk')."';
						</script>";	
		}
	}
}
