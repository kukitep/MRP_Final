<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('User_model');
		$this->load->library('form_validation');
	}
	public function index()
	{
        $data['row'] = $this->User_model->get();

		$this->template->load('template' , 'user/user_data', $data);
	}
	public function add()
	{
		$this->form_validation->set_rules('name' , 'Name' , 'required');
		$this->form_validation->set_rules('username' , 'Username' , 'required|is_unique[user.username]');
		$this->form_validation->set_rules('password' , 'Password' , 'required|min_length[5]');
		$this->form_validation->set_rules('passwordconf' , 'Password confirmation' , 'required|matches[password]',
			array('matches' => '%s doesnt match')
	);
		$this->form_validation->set_rules('level' , 'Level' , 'required');
		
		if ($this->form_validation->run() == FALSE)
                {
						$this->template->load('template' , 'user/user_add');
                }
                else
                {
                       $post = $this->input->post(null, TRUE);
					   $this->User_model->add($post);
					   if($this->db->affected_rows() > 0){
							echo "<script>
							alert('Data Successfully Added');
							</script>";							
						}
						echo "<script>
						window.location='".base_url('user')."';
						</script>";							
                }

		
	}
	
	public function delete()
	{
		$id = $this->input->post('user_id');
		$this->User_model->delete($id);

		if($this->db->affected_rows() > 0){
			echo "<script>
			alert('Data Successfully Deleted');
			</script>";							
		}
		echo "<script>
		window.location='".base_url('user')."';
		</script>";	
	}
	
	public function edit($id)
	{
		$this->form_validation->set_rules('name' , 'Name' , 'required');
		$this->form_validation->set_rules('username' , 'Username' , 'required|callback_username_check');
		if($this->input->post('password'))
		{
		$this->form_validation->set_rules('password' , 'Password' , 'min_length[5]');
		$this->form_validation->set_rules('passwordconf' , 'Password confirmation' , 'matches[password]',
			array('matches' => '%s doesnt match')
			);
		}
		if($this->input->post('passwordconf'))
		{
		$this->form_validation->set_rules('passwordconf' , 'Password confirmation' , 'matches[password]',
			array('matches' => '%s doesnt match')
			);
		}
		$this->form_validation->set_rules('level' , 'Level' , 'required');
		
		if ($this->form_validation->run() == FALSE)
				{
					$query = $this->User_model->get($id);
					if($query->num_rows() > 0) {
					$data['row'] = $query->row();	
					$this->template->load('template' , 'user/user_edit' , $data);
				} else {
					echo "<script>
							alert('Data Not Found');";	
					echo "window.location='".base_url('user')."';
						</script>";	
				}
				}
				else
				{
					   $post = $this->input->post(null, TRUE);
					   $this->User_model->edit($post);
					   if($this->db->affected_rows() > 0){
							echo "<script>
							alert('Data Successfully Updated');
							</script>";							
						}
						echo "<script>
						window.location='".base_url('user')."';
						</script>";							
				}
	
		
	}

	function username_check()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
		if($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check' , '{field} already used');
			return FALSE;
		} else{
			return TRUE;
		}
	}

}
