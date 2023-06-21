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

    <div class="box">
        <div class="box-header">
            <h3 class=""><?=ucfirst($page)?> Manufacturing Order Data</h3>
            <div class="pull-right">
                <a href="<?= base_url("manufacture")?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="<?= base_url('manufacture/process') ?>" method="post">
                        <div class="form-group" >                       
                            <label>Manufacturing No</label> 
                            <input type="hidden" name="manufacture_id" value = "<?= $row->manufacture_id ?>">
                            <input type="text" name="manufacture_no"  value="<?=$row->manufacture_no?>" class="form-control" required>  
                        </div>
                        <div class="form-group" >
                            <label>BOM No</label>
                            <?php echo form_dropdown('header' , $header , $selectedheader , 
                            ['class' => 'form-control' , 'required' => 'required']) ?>
                        </div>
                        <div class="form-group" >                       
                            <label>Scheduled</label> 
                            <input type="datetime-local" name="scheduled" class="form-control"  value="<?=$row->scheduled?>" required>  
                        </div>
                        <div class="form-group" >                       
                            <label>Status</label> 
                            <select name="status" class="form-control"> 
                            <?php $status = $this->input->post('status') ? $this->input->post('status') : $row->status ?>
                                
                                <option value="1"<?=$status == 1 ? 'selected' : null ?>>Pending</option>
                                <option value="2"<?=$status == 2 ? 'selected' : null ?>>In Production</option>
                                <option value="3"<?=$status == 3 ? 'selected' : null ?>>Finished</option>
                                <option value="4"<?=$status == 4 ? 'selected' : null ?>>Cancelled</option>
                                
                            </select>  
                        </div>
                        <div class="form-group" >
                            <label>Description</label>
                            <textarea name="deskripsi" class="form-control" value="<?=$row->description?>" ><?=$row->description?></textarea>
                        </div> 
                        <div class="form-group">
                            <button type="submit" name="<?=$page?>"class="btn btn-success btn-flat"  >Save</button>
                            <a href="<?= base_url("bom/edit/".$row->header_id)?>" class="btn btn-warning btn-flat">
                                <i class="fa fa-undo"></i> Detail BOM
                             </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>