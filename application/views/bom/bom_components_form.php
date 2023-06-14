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

<section>

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
                            <input type="text" name="bom_no" value="<?=$bomno?>" class="form-control" readonly >  
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
                        <div class="form-group" >
                            <label>Component Name</label>
                            <?php echo "<br>"?>
                            <?php echo form_dropdown('raw' , $raw , $selectedraw,
                            ['class' => 'form-control' , 'required' => 'required'] ) ?>
                            <br>
                        </div>
                        <div class="form-group" >        
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control">     
                        </div>
                        <div class="form-group" >
                            <label>Units</label>
                            <?php echo "<br>"?>
                            <?php echo form_dropdown('unit' , $unit , $selectedunit,
                            ['class' => 'form-control' , 'required' => 'required'] ) ?>
                            <br>
                        </div>
                        
                        <div class="form-group">
                        <button type="submit" name="<?=$page?>"class="btn btn-success btn-flat">Add Component</button>
                            <button type="reset" class="btn btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered table-striped">
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
                        <td class="text-center" width="160px">
                            <a href="<?= base_url("bom/deletecomp?compid=".$hasil->component_id.'&bom_id='.$row->header_id)?>" onclick = "return confirm('Delete Component?')" class="btn btn-danger btn-xs">
                                <i class="fa fa-pencil"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

</section>