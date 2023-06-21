<section class="content-header">
    <h1>
        Items
        <small>Data Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Items</li>
    </ol>
</section>

<section class="content">
<?php $this->view('message')?>
    <div class="box">
        <div class="box-header">
            <h3 class="">Items Data</h3>
            <div class="pull-right">
                <a href="<?= base_url("item/add")?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-user-plus"></i> Add Item
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>   
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>                  
                    <?php
                    $no = 1;
                    foreach($row->result() as $data => $hasil) { ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$hasil->name ?></td>
                        <td><?=$hasil->cname ?></td>
                        <td><?=$hasil->qty ?></td>
                        <td><?=($hasil->status == 1 ? "Active"  : "Not Active") ?></td>
                        <td class="text-center" width="160px">
                            <a href="<?= base_url("item/edit/".$hasil->item_id)?>" class="btn btn-primary btn-xs">
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