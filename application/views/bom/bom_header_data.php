<section class="content-header">
    <h1>
        BOM
        <small>Bill of Materials</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Bill of Materials</li>
    </ol>
</section>

<section class="content">
<?php $this->view('message')?>
    <div class="box">
        <div class="box-header">
            <h3 class="">Bill of Materials Data</h3>
            <div class="pull-right">
                <a href="<?= base_url("bom/add")?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-user-plus"></i> Add Bill of Materials
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id='table1'>
                <thead>
                    <tr>   
                        <th>No</th>
                        <th>BOM Number</th>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>BOM Status</th>
                        <th>Actions</th>
                        <th>Components</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    $no = 1;
                    foreach($row->result() as $data => $hasil) { ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$hasil->bom_no ?></td>
                        <td><?=$hasil->name ?></td>
                        <td><?=$hasil->pname ?></td>
                        <td><?=$hasil->qty ?></td>
                        <td><?=($hasil->status == 1 ? "Active"  : "Not Active") ?></td>
                        <td class="text-center" width="160px">
                            <a href="<?= base_url("bom/edit/".$hasil->header_id)?>" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            
                        </td>
                        <td class="text-center" width="160px">
                            <a href="<?= base_url("bom/insertcomponents/".$hasil->header_id)?>" class="btn btn-success
                             btn-xs">
                             <i class="fa fa-plus" aria-hidden="true"></i> Add
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>