<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function login()
	{
		$this->load->view('login');
		check_already_login();
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($post['login']))
		{
			$this->load->model('User_model');
			$query = $this->User_model->login($post);
			if($query->num_rows() > 0) {
				$row = $query->row();
				$params = array(
					'userid' => $row->user_id,
					'level' => $row->level
				);
				$this->session->set_userdata($params);
				echo "<script> alert('Login Successful'); window.location='".base_url('dashboard')."'; </script>";
			} else {
				echo "<script> alert('Login Failed'); window.location='".base_url('auth/login')."'; </script>";
			}
		} 
	}
	
	public function logout() 
	{
		$params = array('userid','level');
		$this->session->unset_userdata($params);
		redirect('auth/login');
	}
}
