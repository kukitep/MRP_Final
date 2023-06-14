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
            <h3 class=""><?=ucfirst($page)?> Bill of Materials</h3>
            <div class="pull-right">
                <a href="<?= base_url("bom")?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="<?= base_url('bom/processinsertraw') ?>" method="post">
                        <div class="form-group" >
                            <input type="hidden" name="bom_id" value="<?= $row->header_id ?>">
                            <label>BOM No</label>
                            <input type="text" name="bom_no" value="<?=$row->bom_no?>" class="form-control" readonly >  
                        </div>
                        <div class="form-group" >        
                            <label>Name</label>
                            <input type="text" name="bom_name" value="<?=$row->name?>" class="form-control" readonly>     
                        </div>
                        <div class="form-group" >
                            <label>Product Name</label>
                            <?php echo "<br>"?>
                            <?php echo form_dropdown('item' , $item , $selecteditem , 'disabled = "disabled"',
                            ['class' => 'form-control' , 'readonly' => 'TRUE'] ) ?>
                            <br>
                        </div> 
                        <div class="box-header">
                            <h3 class="">Components</h3>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>   
                        <th>No</th>
                        <th>Component</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    $no = 1;
                    foreach($rowcomponent->result() as $data => $hasil) { ?>
                    <tr>
                        <td><?=$no++?></td>                   
                        <td><?=$hasil->pname ?></td>                   
                        <td><?=$hasil->quantity ?></td>                   
                        <td><?=$hasil->uname ?></td>                    
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

</section>