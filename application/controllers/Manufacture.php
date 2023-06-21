<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacture extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['manufacture_model' , 'category_model' , 'unit_model' , 'bom_model']);

	}

	public function index()
	{
		$data['row'] = $this->manufacture_model->get();
		$this->template->load('template' , 'manufacture/manufacture_data',$data);
		
	}
	
	public function delete($id)
	{
        $this->manufacture_model->delete($id);
		if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success','Data Successfuly Deleted');															
		}
		redirect('manufacture');
	}
	
	public function add()
	{
		$manufacture = new stdClass();
		$manufacture->manufacture_id = null;
		$manufacture->manufacture_no = null;
		$manufacture->description = null;
		$manufacture->scheduled = null;
		$manufacture->header_id = null;

		$query_header = $this->bom_model->get_active();

        $cdate = date('Y-m-d H:i:s');
		$header[null] = '- Choose BOM -';
		foreach($query_header->result() as $head) {
			$header[$head->header_id] = $head->bom_no;
;		}
		

		$data = array(
			'page' => 'add',
			'row' => $manufacture,
            'cdate' => $cdate,
			'header' => $header , 'selectedheader' => null,

		);
		$this->template->load('template' , 'manufacture/manufacture_form',$data);					
		
	}

	public function process()
	{

		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])){
			$this->manufacture_model->add($post);
		} else if(isset($_POST['edit'])){
			$this->manufacture_model->edit($post);
		}

		if($this->db->affected_rows() > 0){
            if(isset($_POST['add'])){
			$this->session->set_flashdata('success','Data Successfuly Added');
            } else if(isset($_POST['edit'])){           
            $this->session->set_flashdata('success','Data Successfuly Saved');
            }				
		}
		redirect('manufacture');
		
	}
	
	public function edit($id)
	{
		$query = $this->manufacture_model->get($id);
	
		if($query->num_rows() > 0) {
			$manufacture = $query->row();

            $query_header = $this->bom_model->get();

			$header[null] = '- Choose BOM -';
		foreach($query_header->result() as $head) {
			$header[$head->header_id] = $head->bom_no;
;		}

			$data = array(
				'page' => 'edit',
				'row' => $manufacture,
				'header' => $header , 'selectedheader' => $manufacture->header_id,
				
	
			);
			$this->template->load('template' , 'manufacture/manufacture_form',$data);
			
		} else {
			echo "<script>
							alert('Data Not Found');";	
					echo "window.location='".base_url('manufacture')."';
						</script>";	
		}
		
	}
}
