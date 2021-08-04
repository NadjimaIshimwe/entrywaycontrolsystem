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
if (empty($_POST['from']) and empty($_POST['to']) and empty($_POST['schedule'])) {
    $from = $_GET['from'];
    $to = $_GET['to'];
    $schedule = $_GET['schedule'];
} else {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $schedule = $_POST['schedule'];
}


if (!empty($from) and !empty($to) and $schedule != "all_check") {
?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            People History
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?php

                                $sql_schedule = " SELECT * FROM tbl_place WHERE place_id='$schedule' ";
                                $query_2 = $conn->prepare($sql_schedule);
                                $query_2->execute();
                                $sch_data = $query_2->rowCount();
                                while ($fetch_2 = $query_2->fetch()) {
                                    $sched = $fetch_2['place_name'];
                                }

                                ?>
                            Export People History From <b><?php echo $from; ?></b> To <b><?php echo $to; ?></b> In
                            <b><?php echo $sched; ?></b>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Reg No</th>
                                        <th>Names</th>
                                        <th>Phone</th>
                                        <th>ID No</th>
                                        <th>Entrance Time</th>
                                        <th>Exit Time</th>
                                        <th>Entrance date</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Reg No</th>
                                        <th>Names</th>
                                        <th>Phone</th>
                                        <th>ID No</th>
                                        <th>Entrance Time</th>
                                        <th>Exit Time</th>
                                        <th>Entrance date</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $no = 0;
                                        $sql = " SELECT tbl_user.user_id,tbl_user.f_name,tbl_user.l_name,tbl_user.mobile_no,tbl_user.id_no,tbl_user.reg_no,tbl_place.place_id,tbl_place.place_name,tbl_records.entrance_time,tbl_records.exit_time,tbl_records.rec_date FROM tbl_user,tbl_place,tbl_records WHERE tbl_records.user_id=tbl_user.user_id AND tbl_records.place_id=tbl_place.place_id AND tbl_records.place_id ='$schedule' AND tbl_records.rec_date BETWEEN '$from' AND '$to' ORDER BY tbl_records.rec_id DESC ";
                                        $query = $conn->prepare($sql);
                                        $query->execute();

                                        while ($fetch = $query->fetch()) {
                                            $client_id = $fetch['user_id'];
                                            $no += 1;

                                            if ($fetch['exit_time'] == NULL) {
                                                $exit_time = "<b style='color:red'>Still Inside</b>";
                                            } else {
                                                $exit_time = $fetch['exit_time'];
                                            }
                                        ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $fetch['reg_no'] ?></td>
                                        <td><?php echo $fetch['f_name'] ?> <?php echo $fetch['l_name'] ?></td>
                                        <td><?php echo $fetch['mobile_no'] ?></td>
                                        <td><?php echo $fetch['id_no'] ?></td>
                                        <td><?php echo $fetch['entrance_time'] ?></td>
                                        <td><?php echo $exit_time; ?></td>
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
} else if ($schedule == "all_check") {
?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <h2>
                                People History In All Check Points
                            </h2>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Export People History From <b><?php echo $from; ?></b> To <b><?php echo $to; ?></b> In
                            <b>All Check Points</b>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <form class="form-horizontal" method="POST" action="export_records.php">
                                    <input type="hidden" name="from" value="<?php echo $from; ?>">
                                    <input type="hidden" name="to" value="<?php echo $to; ?>">
                                    <input type="hidden" name="place_id" value="<?php echo $prof_id; ?>">
                                    <input type="hidden" name="place_name" value="<?php echo $f_name; ?>">
                                    <button type="submit" name="export_people_records"
                                        class="btn btn-success">Export</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="body">

                        <!-- Data Table -->
                        <div class="body">
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-striped table-hover dataTable js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Reg No</th>
                                            <th>Names</th>
                                            <th>Phone</th>
                                            <th>ID No</th>
                                            <th>Entrance Time</th>
                                            <th>Exit Time</th>
                                            <th>Entrance date</th>
                                            <th>Check Point</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Reg No</th>
                                            <th>Names</th>
                                            <th>Phone</th>
                                            <th>ID No</th>
                                            <th>Entrance Time</th>
                                            <th>Exit Time</th>
                                            <th>Entrance date</th>
                                            <th>Check Point</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                            // CHECKING MY ALL CHECK POINTS
                                            $sql_place_check = " SELECT * FROM tbl_place ";
                                            $stmt = $conn->prepare($sql_place_check);
                                            $stmt->execute();
                                            $array_place = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            $total_place = array();

                                            foreach ($array_place as $row_place) {
                                                $total_place[] = $row_place['place_id'];
                                            }
                                            $total_place_array = implode(',', $total_place);

                                            $no = 0;
                                            $sql = " SELECT tbl_user.user_id,tbl_user.f_name,tbl_user.l_name,tbl_user.mobile_no,tbl_user.id_no,tbl_place.place_id,tbl_place.place_name,tbl_records.entrance_time,tbl_records.exit_time,tbl_records.rec_date FROM tbl_user,tbl_place,tbl_records WHERE tbl_records.user_id=tbl_user.user_id AND tbl_records.place_id=tbl_place.place_id AND tbl_records.rec_date BETWEEN '$from' AND '$to' AND tbl_records.place_id IN ($total_place_array) ORDER BY tbl_records.rec_id DESC ";
                                            $query = $conn->prepare($sql);
                                            $query->execute();

                                            while ($fetch = $query->fetch()) {
                                                $client_id = $fetch['user_id'];
                                                $place_id = $fetch['place_id'];
                                                $no += 1;

                                                if ($fetch['exit_time'] == NULL) {
                                                    $exit_time = "<b style='color:red'>Still Inside</b>";
                                                } else {
                                                    $exit_time = $fetch['exit_time'];
                                                }
                                            ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $fetch['reg_no'] ?></td>
                                            <td><?php echo $fetch['f_name'] ?> <?php echo $fetch['l_name'] ?></td>
                                            <td><?php echo $fetch['mobile_no'] ?></td>
                                            <td><?php echo $fetch['id_no'] ?></td>
                                            <td><?php echo $fetch['entrance_time'] ?></td>
                                            <td><?php echo $exit_time; ?></td>
                                            <td><?php echo $fetch['rec_date'] ?></td>
                                            <td><?php echo $fetch['place_name'] ?></td>
                                        </tr>
                                        <?php
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Of Data Table -->

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