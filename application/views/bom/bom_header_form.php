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
                    <form action="<?= base_url('bom/process') ?>" method="post">
                        <div class="form-group" >
                            <input type="hidden" name="bom_id" value="<?= $row->header_id ?>">
                            <label>BOM No</label>
                            <input type="text" name="bom_no" value="<?=$row->bom_no?>" class="form-control" required>  
                        </div>
                        <div class="form-group" >        
                            <label>Name</label>
                            <input type="text" name="bom_name" value="<?=$row->name?>" class="form-control" required>  
                        </div>
                        <div class="form-group" >
                            <label>Product Name</label>
                            <?php echo form_dropdown('item' , $item , $selecteditem , 
                            ['class' => 'form-control' , 'required' => 'required']) ?>
                        </div>
                        <div class="form-group" >
                            <label>Description</label>
                            <textarea name="deskripsi" class="form-control" value="<?=$row->description?>" ><?= $row->description?></textarea>
                        </div>
                        <div class="form-group" >
                            <label>Status</label>
                            <select name="status" class="form-control">   
                            <?php $level = $this->input->post('status') ? $this->input->post('status') : $row->status ?>
                                <option value="1">Active</option> 
                                <option value="2"<?=$level == 2 ? 'selected' : null ?>>Not Active</option> 
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="<?=$page?>"class="btn btn-success btn-flat">Save</button>
                            <button type="reset" class="btn btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>