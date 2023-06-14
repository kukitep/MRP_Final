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
            <h3 class="">Product Data</h3>
            <div class="pull-right">
                <a href="<?= base_url("produk/add")?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-user-plus"></i> Add Product
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>   
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    $no = 1;
                    foreach($row->result() as $data => $hasil) { ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$hasil->name ?></td>
                        <td><?=$hasil->category ?></td>
                        <td class="text-center" width="160px">
                            <a href="<?= base_url("produk/edit/".$hasil->product_id)?>" class="btn btn-primary btn-xs">
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