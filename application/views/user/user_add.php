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
            <h3 class="">Add User</h3>
            <div class="pull-right">
                <a href="<?= base_url("user")?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="" method="post">
                        <div class="form-group<?= form_error("name") ? 'has-error' : null ?>" >
                            <label>Name</label>
                            <input type="text" name="name" value="<?= set_value('name') ?>" class="form-control">  
                            <small class="text-danger pl-4"><?= form_error("name"); ?></small>
                        </div>
                        <div class="form-group<?= form_error("username") ? 'has-error' : null ?>" >
                            <label>Username</label>
                            <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control">    
                            <small class="text-danger pl-4"><?= form_error("username"); ?></small>
                        </div>
                        <div class="form-group<?= form_error("password") ? 'has-error' : null ?>" >
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">    
                            <small class="text-danger pl-4"><?= form_error("password"); ?></small>
                        </div>
                        <div class="form-group<?= form_error("passwordconf") ? 'has-error' : null ?>" >
                            <label>Password Confirmation</label>
                            <input type="password" name="passwordconf" class="form-control">    
                            <small class="text-danger pl-4"><?= form_error("passwordconf"); ?></small>
                        </div>
                        <div class="form-group<?= form_error("level") ? 'has-error' : null ?>" >
                            <label>Level</label>
                            <select name="level" class="form-control">   
                                <option value="">-Choose Level-</option> 
                                <option value="1">Manager</option> 
                                <option value="2">User</option> 
                            </select>
                            <small class="text-danger pl-4"><?= form_error("level"); ?></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat">Add</button>
                            <button type="reset" class="btn btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>