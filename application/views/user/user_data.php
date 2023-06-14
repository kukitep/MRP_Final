<section class="content-header">
    <h1>
        Users
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Users</li>
    </ol>
</section>

<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="">User Data</h3>
            <div class="pull-right">
                <a href="<?= base_url("user/add")?>" class="btn btn-primary btn-flat">
                    <i class="fa fa-user-plus"></i> Add User
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>   
                        <th>No</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    $no = 1;
                    foreach($row->result() as $data => $hasil) { ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$hasil->username ?></td>
                        <td><?=$hasil->name ?></td>
                        <td><?=($hasil->level == 1 ? "Manager" : ($hasil->level == 2 ? "Employee" : "Admin")) ?></td>
                        <td class="text-center" width="160px">
                            <form action="<?= base_url('user/delete') ?>" method="post">
                            <a href="<?= base_url("user/edit/".$hasil->user_id)?>" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            <input name="user_id" type="hidden" value="<?=$hasil->user_id?>">
                            <button onclick="return confirm('Are you sure?')"class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>