<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bom extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['bom_model' , 'item_model' , 'unit_model']);
	}

	public function index()
	{
		$data['row'] = $this->bom_model->get();
		$this->template->load('template' , 'bom/bom_header_data',$data);
		
	}
	
	public function delete($id)
	{
        $this->bom_model->delete($id);
		if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success','Data Successfuly Deleted');															
		}
		redirect('bom');
	}
	public function deletecomp()
	{
		$query = $this->input->get();
		$id = $query['compid'];

        $this->bom_model->deletecomp($id);
		if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success','Data Successfuly Deleted');															
		}
		header("Location: /skripsi/bom/insertcomponents/".$query['bom_id']);
	}
	
	public function add()
	{
		$bom = new stdClass();
		$bom->header_id = null;
		$bom->bom_no = null;
		$bom->name = null;
		$bom->product = null;
		$bom->description = null;
		$bom->level = null;


        $query_item = $this->item_model->get_fp();

		$item[null] = '- Choose Item -';
		foreach($query_item->result() as $itm) {
			$item[$itm->item_id] = $itm->name;
        ;}

		$data = array(
			'page' => 'add',
			'row' => $bom,
            'item' => $item , 'selecteditem' => null

		);
		$this->template->load('template' , 'bom/bom_header_form',$data);					
		
	}

	public function process()
	{

		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])){
			$this->bom_model->add($post);
		} else if(isset($_POST['edit'])){
			$this->bom_model->edit($post);
		}

		if($this->db->affected_rows() > 0){
            if(isset($_POST['add'])){
			$this->session->set_flashdata('success','Data Successfuly Added');
            } else if(isset($_POST['edit'])){           
            $this->session->set_flashdata('success','Data Successfuly Saved');
            }				
		}
		redirect('bom');
		
	}
	public function processinsertraw()
	{
		
		$post = $this->input->post(null, TRUE);

		if(isset($_POST['addcom'])){
			$this->bom_model->addcom($post);
		} else if(isset($_POST['edit'])){
			$this->bom_model->edit($post);
		}

		if($this->db->affected_rows() > 0){
            if(isset($_POST['addcom'])){
			$this->session->set_flashdata('success','Data Successfuly Added');
            } else if(isset($_POST['edit'])){           
            $this->session->set_flashdata('success','Data Successfuly Saved');
            }				
		} else {
			echo "gagal";
		}
		header("Location: /skripsi/bom/insertcomponents/".$post['bom_id']);
		
	}
	
	public function edit($id)
	{
		$query = $this->bom_model->get($id);
		
		if($query->num_rows() > 0) {
            $query_item = $this->item_model->get_fp();

            $item[null] = '- Choose Item -';
            foreach($query_item->result() as $itm) {
                $item[$itm->item_id] = $itm->name;
            ;}
			$bom = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $bom,
                'item' => $item , 'selecteditem' => $bom->item_id,
				
			);
			$this->template->load('template' , 'bom/bom_header_form',$data);
			
			
		} else {
			echo "<script>
			alert('Data Not Found');";	
			echo "window.location='".base_url('bom')."';
			</script>";	
		}
	}

	public function addcomponents($id)
	{

		$query = $this->bom_model->get($id);
		$querycomponents = $this->bom_model->getcomponent($id);
		if($query->num_rows() > 0) {
			$query_item = $this->item_model->get_fp();
			$query_raw = $this->item_model->get_raw();
			$bom = $query->row();
			$component = $querycomponents->row();
            $item[null] = '- Choose Item -';
            foreach($query_item->result() as $itm) {
				$item[$itm->item_id] = $itm->name;
				;}									
            $raw[null] = '- Choose Item -';
            foreach($query_raw->result() as $rw) {
				$raw[$rw->item_id] = $rw->name;
				;}			
				$data = array(
				'page' => 'edit',
				'row' => $bom,
				'rows' => $component,
                'item' => $item , 'selecteditem' => $bom->item_id,
                'raw' => $raw , 'selectedraw' => $bom->item_id,
			);
			
			$data['rowcomponent'] = $this->bom_model->getcomponent();
			$this->template->load('template' , 'bom/bom_components_data',$data);
			
			
		} else {
			echo "<script>
			alert('Data Not Found');";	
			echo "window.location='".base_url('bom')."';
			</script>";	
		}
	}
	public function insertcomponents($id)
	{

		$query = $this->bom_model->get($id);
		$querycomponents = $this->bom_model->getcomponent($id);
		if($query->num_rows() > 0) {
			$query_unit = $this->unit_model->get();
			$query_item = $this->item_model->get_fp();
			$query_raw = $this->item_model->get_raw();
			$bom = $query->row();
			$bomno = $bom->bom_no;
			$component = $querycomponents->row();
            $item[null] = '- Choose Item -';
            foreach($query_item->result() as $itm) {
				$item[$itm->item_id] = $itm->name;
				;}					
            $raw[null] = '- Choose Item -';
            foreach($query_raw->result() as $rw) {
				$raw[$rw->item_id] = $rw->name;
				;}					
            $unit[null] = '- Choose Unit -';
            foreach($query_unit->result() as $unt) {
				$unit[$unt->unit_id] = $unt->name;
				;}					
				$data = array(
				'page' => 'addcom',
				'row' => $bom,
				'rows' => $component,
				'bomno' => $bomno,
                'item' => $item , 'selecteditem' => $bom->item_id,
                'raw' => $raw , 'selectedraw' => $bom->item_id,
                'unit' => $unit , 'selectedunit' => null,
			);
			
			$data['rowcomponent'] = $this->bom_model->getcomponent($id);
			$this->template->load('template' , 'bom/bom_components_form',$data);
			
			
		} else {
			echo "<script>
			alert('Data Not Found');";	
			echo "window.location='".base_url('bom')."';
			</script>";	
		}
	}
	public function insertcom()
	{

		$query = $this->bom_model->get($id);
		$querycomponents = $this->bom_model->getcomponent($id);
		if($query->num_rows() > 0) {
			$query_item = $this->item_model->get_fp();
			$query_raw = $this->item_model->get_raw();
			$bom = $query->row();
			$component = $querycomponents->row();
            $item[null] = '- Choose Item -';
            foreach($query_item->result() as $itm) {
				$item[$itm->item_id] = $itm->name;
				;}					
            $raw[null] = '- Choose Item -';
            foreach($query_raw->result() as $rw) {
				$raw[$rw->item_id] = $rw->name;
				;}			
				$data = array(
				'page' => 'addcom',
				'row' => $bom,
				'rows' => $component,
                'item' => $item , 'selecteditem' => $bom->item_id,
                'raw' => $raw , 'selectedraw' => $bom->item_id,
			);
			
			$data['rowcomponent'] = $this->bom_model->getcomponent();
			$this->template->load('template' , 'bom/bom_components_form',$data);
			
			
		} else {
			echo "<script>
			alert('Data Not Found');";	
			echo "window.location='".base_url('bom')."';
			</script>";	
		}
	}
	
	
	

  
  }


