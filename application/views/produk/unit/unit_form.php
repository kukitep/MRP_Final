<section class="content-header">
<h1>
        Units
        <small>Satuan Unit Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Units</li>
    </ol>
</section>

<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class=""><?=ucfirst($page)?> Unit</h3>
            <div class="pull-right">
                <a href="<?= base_url("unit")?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="<?= base_url('unit/process') ?>" method="post">
                        <div class="form-group" >
                            <input type="hidden" name="unit_id" value="<?= $row->unit_id ?>">
                            <label>Name</label>
                            <input type="text" name="unit_name" value="<?=$row->name?>" class="form-control" required>  
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
                            <button onclick="return confirm('Save Data?')" type="submit" name="<?=$page?>"class="btn btn-success btn-flat">Save</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>