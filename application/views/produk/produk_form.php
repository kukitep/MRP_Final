<section class="content-header">
    <h1>
        Products
        <small>Produk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Products</li>
    </ol>
</section>

<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class=""><?=ucfirst($page)?> Product</h3>
            <div class="pull-right">
                <a href="<?= base_url("produk")?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="<?= base_url('produk/process') ?>" method="post">
                        <div class="form-group" >
                            <input type="hidden" name="product_id" value="<?= $row->product_id ?>">
                            <label>Name</label>
                            <input type="text" name="produk_name" value="<?=$row->name?>" class="form-control" required>  
                        </div>
                        <div class="form-group" >
                            <label>Category</label>
                            <input type="text" name="category" value="<?=$row->category?>" class="form-control" required>  
                        </div>
                        <div class="form-group">
                            <button onclick="return confirm('Save Data?')" type="submit" name="<?=$page?>" class="btn btn-success btn-flat">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
