<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['manufacture_model' , 'category_model' , 'unit_model' , 'bom_model','dashboard_model']);

	}
	public function index()
	{
		$data['row'] = $this->manufacture_model->get();
		$data['pending'] = $this->dashboard_model->get_pending();
		$data['cancel'] = $this->dashboard_model->get_cancel();
		$data['finish'] = $this->dashboard_model->get_finish();
		$data['inprog'] = $this->dashboard_model->get_inprog();
		$this->template->load('template' , 'dashboard',$data);
	}
}
