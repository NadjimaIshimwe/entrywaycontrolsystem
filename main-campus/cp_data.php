<?php
include('../includes/header.php');
include('../includes/links.php');
?>


<?php include('../includes/top_bar.php'); ?>
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <?php include('profile.php'); ?>
        <!-- #User Info -->

        <!-- Menu -->
        <?php include('sidebar.php'); ?>
        <!-- #Menu -->

        <!-- Footer -->
        <?php include('../includes/footer.php'); ?>
        <!-- #Footer -->
    </aside>
</section>

<?php

$place_get = $_GET['place'];
$today_get = $_GET['today'];

$place = $place_get;
$today = $today_get;

if (!empty($place) and !empty($today)) {
?>
<section class="content">
    <div class="container-fluid">

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Gate Records For <b><?php echo $today; ?></b>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Names</th>
                                        <th>User Type</th>
                                        <th>Phone</th>
                                        <th>National ID</th>
                                        <th>Stuffs</th>
                                        <th>Entrance Time</th>
                                        <th>Entrance date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0;
                                        $sql = " SELECT tbl_user.user_id,tbl_user.f_name,tbl_user.l_name,tbl_user.mobile_no,tbl_user.id_no,tbl_user.user_type,tbl_place.place_id,tbl_place.place_name,tbl_records.entrance_time,tbl_records.exit_time,tbl_records.stuffs,tbl_records.rec_date FROM tbl_user,tbl_place,tbl_records WHERE tbl_records.user_id=tbl_user.user_id AND tbl_records.place_id= tbl_place.place_id AND tbl_records.place_id ='$place' AND tbl_records.rec_date = '$today' ORDER BY tbl_records.rec_id DESC ";
                                        $query = $conn->prepare($sql);
                                        $query->execute();
                                        while ($fetch = $query->fetch()) {
                                            $client_id = $fetch['user_id'];
                                            $no += 1;

                                            // 			if($fetch['exit_time'] == NULL){
                                            // 			    $exit_time = "<b style='color:red'>Didn't Exit</b>";
                                            // 			}else{
                                            // 			    $exit_time = $fetch['exit_time'] ;
                                            // 			}

                                        ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $fetch['f_name'] ?> <?php echo $fetch['l_name'] ?></td>
                                        <td><?php echo $fetch['user_type'] ?></td>
                                        <td><?php echo $fetch['mobile_no'] ?></td>
                                        <td><?php echo $fetch['id_no'] ?></td>
                                        <td><?php echo $fetch['stuffs'] ?></td>
                                        <td><?php echo $fetch['entrance_time'] ?></td>
                                        <td><?php echo $fetch['rec_date'] ?></td>
                                    </tr>
                                    <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

<?php
} else {
?>

<section class="content">
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Sorry No Data Available
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
}
?>

<?php include('../includes/js.php'); ?>
</body>

</html>