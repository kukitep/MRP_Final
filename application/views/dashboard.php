
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$inprog?></h3>

              <p>In Production</p>
            </div>
            <div class="icon">
              <i class="ion-android-alarm-clock"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$finish?></h3>

              <p>Finished</p>
            </div>
            <div class="icon">
              <i class="ion-android-done"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$pending?></h3>

              <p>Pending</p>
            </div>
            <div class="icon">
              <i class="ion-alert"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$cancel?></h3>

              <p>Cancelled</p>
            </div>
            <div class="icon">
              <i class="ion-android-close"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      
      <div class="box">
        <div class="box-header">
            <h3 class="">Manufacturing Order Data</h3>
            <div class="pull-right">
               <select name="" class="form-control" id="status">
                <option value="0">Show All</option> 
                <option value="1">Pending</option> 
                <option value="2">In Production</option> 
                <option value="3">Finished</option> 
                <option value="4">Cancelled</option> 
               </select>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>   
                        <th>No</th>
                        <th>Manufacturing No</th>
                        <th>BOM No</th>
                        <th>Product Manufactured</th>
                        <th>Created</th>
                        <th>Scheduled</th>
                        <th>Updated</th>
                        <th>Status</th>
                        <th>Detail MO</th>
                        <th>Detail BO</th>
                    </tr>
                </thead>
                <tbody> <?php                  
                $no = 1;
                    foreach($row->result() as $data => $hasil) { ?>
                    <tr >
                     
                        <td><?=$no++?></td>   
                        <td href="<?= base_url("manufacture/edit/".$hasil->manufacture_id)?>" class="text">
                            <?=$hasil->manufacture_no ?>
                        </td>
                        <td><?=$hasil->bno ?></td>
                        <td><?=$hasil->pname ?></td>
                        <td><?=$hasil->created ?></td>
                        <td><?=$hasil->scheduled ?></td>
                        <td><?=$hasil->updated ?></td>
                        <td><?=($hasil->status == 1 ? "<p class='text-center bg-warning text-dark'>Pending</p>" : ($hasil->status == 2 ? "<p class='text-center bg-info'>In Production</p>" : ($hasil->status == 3 ? "<p class='text-center bg-success'>Finished</p>" : "<p class='text-center bg-danger'>Cancelled</p>"))) ?></td>
                        <td class="text-center" width="100px">
                            <a href="<?= base_url("manufacture/edit/".$hasil->manufacture_id)?>" class="btn btn-primary btn-xs">
                                <i></i> Detail MO
                            </a>
                        </td>
                        <td class="text-center" width="100px">
                            <a href="<?= base_url("bom/insertcomponents/".$hasil->header_id)?>" class="btn btn-warning btn-xs">
                                <i></i> Detail BOM
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
</section>
    <script>
      $(document).ready(function() {
          $("#status").change(function(){
              status();
          });
      });

      function status(){
        var status = $("#status").val();
        $.ajax({
          url : "<?= base_url('Dashboard/filter') ?>",
          data: "status=" + status,
          success:function(data){
            //$("#table1 tbody").html('<tr><td colspan="4" align="center">No Data</td></tr>')
            $("#table1").html(data);
          }
        })
      }

    </script>