<?php
include("../includes/db_controller.php");
$dateTo = $_REQUEST['dateTo'];
$dateFrom = $_REQUEST['dateFrom'];
?>
<?php
$no = 0;
$sql = "SELECT * FROM tbl_access_control WHERE DATE_FORMAT(timein, '%Y-%m-%d') BETWEEN '" . $dateFrom . "' AND '" . $dateTo . "'";
$query = $conn->prepare($sql);
$query->execute();
$rowcount = $query->rowCount();
if ($rowcount > 0) {
?>
<div align="right" style="margin:5px;">
    <a href="ExcelrptstdEntrace?dateFrom=<?php echo $dateFrom; ?>&dateTo=<?php echo $dateTo; ?>"
        class="btn btn-success btn-rounded pull-right btn-sm"><i class="fa fa-file-text"></i> Export Excel</a>
</div><br><br><br>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="font-size:11px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Reg No</th>
                <th>Names</th>
                <th>Phone</th>
                <th style="padding: 0 55px;">Faculty</th>
                <th>Department</th>
                <th>Session</th>
                <th>Gate</th>
                <th style="padding: 0 45px;">Date & Time</th>
            </tr>
        </thead>
        <tbody>
            <?php

                while ($fetch = $query->fetch()) {
                    $no += 1;
                    $regno = $fetch['regno'];
                    $camp = $fetch['staff_get_id'];

                    $sqlget = $conn->prepare("SELECT * FROM tbl_place WHERE place_id = '" . $camp . "'");
                    $sqlget->execute();
                    $rows = $sqlget->fetch();
                    $place = $rows['place_name'];

                    $stsql = " SELECT * FROM tbl_user WHERE registration_number = '" . $regno . "' ";
                    $stquery = $conn->prepare($stsql);
                    $stquery->execute();
                    $stfetch = $stquery->fetch();

                    // 		faculty
                    $fac = $stfetch['faculity_id'];
                    $facsql = " SELECT * FROM faculities where id=$fac";
                    $facquery = $conn->prepare($facsql);
                    $facquery->execute();
                    $facfetch = $facquery->fetch();

                    //      department
                    $dept = $stfetch['department_id'];
                    $deptsql = " SELECT * FROM departments where id=$dept";
                    $deptquery = $conn->prepare($deptsql);
                    $deptquery->execute();
                    $deptfetch = $deptquery->fetch();

                ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $stfetch['registration_number'] ?></td>
                <td><?php echo $stfetch['names'] ?></td>
                <td><?php echo $stfetch['telephone'] ?></td>
                <td><?php echo $facfetch['description'] ?></td>
                <td><?php echo $deptfetch['name'] ?></td>
                <td><?php echo $stfetch['session'] ?></td>
                <td><?php echo $place; ?></td>
                <td><?php echo $fetch['timein'] . ' ' . $fetch['entrance_time']; ?></td>
            </tr>
            <?php
                }
                ?>
        </tbody>
    </table>
</div>
<?php } ?>