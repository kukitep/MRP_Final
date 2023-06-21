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

	public function filter(){
        $status = $_GET['status'];
        $data = $this->manufacture_model->get_where('p_manufacture', ['status'=>$status])->result();
		
                    $no = 1;
                    foreach($row->result() as $data => $hasil) { ?>
                    <tr >
                        <td><?=$no++?></td>   
                        <td href="<?= base_url("manufacture/edit/".$hasil->manufacture_id)?>" class="text">
                            <?=$hasil->manufacture_no ?>
                        </td>
                        <td><?=$hasil->bno ?></td>
                        <td><?=$hasil->pname ?></td>
                        <td><?=$hasil->created ?></td>
                        <td><?=$hasil->scheduled ?></td>
                        <td><?=$hasil->updated ?></td>
                        <td><?=($hasil->status == 1 ? "<p class='text-center bg-warning text-dark'>Pending</p>" : ($hasil->status == 2 ? "<p class='text-center bg-info'>In Production</p>" : ($hasil->status == 3 ? "<p class='text-center bg-success'>Finished</p>" : "<p class='text-center bg-danger'>Cancelled</p>"))) ?></td>
                        <td class="text-center" width="100px">
                            <a href="<?= base_url("manufacture/edit/".$hasil->manufacture_id)?>" class="btn btn-primary btn-xs">
                                <i></i> Detail MO
                            </a>
                        </td>
                        <td class="text-center" width="100px">
                            <a href="<?= base_url("bom/insertcomponents/".$hasil->header_id)?>" class="btn btn-warning btn-xs">
                                <i></i> Detail BOM
                            </a>
                        </td>
                    </tr>
                    <?php } ?><?php
    }
}
