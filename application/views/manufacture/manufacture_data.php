<section class="content-header">
    <h1>
        Manufacturing Order
        <small>Data Manufacturing Order</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Manufacturing Order</li>
    </ol>
</section>

<section class="content">
<?php $this->view('message')?>
    <div class="box">
        <div class="box-header">
            <h3 class="">Manufacturing Order Data</h3>
            <div class="pull-right">
                <a href="<?= base_url("manufacture/add")?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-user-plus"></i> Add Manufacturing Order
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>   
                        <th>No</th>
                        <th>Manufacturing No</th>
                        <th>BOM No</th>
                        <th>Product Manufactured</th>
                        <th>Created</th>
                        <th>Scheduled</th>
                        <th>Updated</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>                  
                    <?php
                    $no = 1;
                    foreach($row->result() as $data => $hasil) { ?>
                    <tr >
                        <td><?=$no++?></td>   
                        <td href="<?= base_url("manufacture/delete/".$hasil->manufacture_id)?>" onclick = "return confirm('Delete data?')" class="text">
                            <?=$hasil->manufacture_no ?>
                        </td>
                        <td><?=$hasil->bno ?></td>
                        <td><?=$hasil->pname ?></td>
                        <td><?=$hasil->created ?></td>
                        <td><?=$hasil->scheduled ?></td>
                        <td><?=$hasil->updated ?></td>
                        <td><?=($hasil->status == 1 ? "Pending" : ($hasil->status == 2 ? "In Production" : ($hasil->status == 3 ? "Finished" : "Cancelled"))) ?></td>
                        <td class="text-center" width="160px">
                            <a href="<?= base_url("manufacture/edit/".$hasil->manufacture_id)?>" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                           
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>