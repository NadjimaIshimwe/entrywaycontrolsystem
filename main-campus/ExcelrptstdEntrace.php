<?php
header('Content-type: text/html; charset=utf-8');
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Users_Available | $_POST[date](excel_file).xls");
?>

<?php
$DB_ICON = new PDO('mysql:host=localhost;dbname=db_entryway', 'root', '');
$dateTo = $_REQUEST['dateTo'];
$dateFrom = $_REQUEST['dateFrom'];
?>

<style type="text/css">
td {
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 3px;
    padding-bottom: 3px;
    border: 1px solid #666;
    font-size: 19px;
    /*text-align:center;*/
    min-width: 120px;
}

.header {
    padding-top: 15px;
    padding-bottom: 15px;
    color: #fff;
    background-color: #68A9BD;

}

.title {
    border: 0px;
    text-align: left;
    font-weight: 600;
}

.color_title {
    color: #68A9BD;
}

.danger {
    padding-top: 15px;
    padding-bottom: 15px;
    color: #fff;
    background-color: #B22222;

}

.success {
    padding-top: 15px;
    padding-bottom: 15px;
    color: #fff;
    background-color: #006400;

}
</style>

<div style='padding: 10px;border-radius: 8px;border: 2px solid #73AD21;width:90%;margin-top:1%;margin-bottom:1%;'>
    <p style="font-family: 'Times New Roman', Times, serif;font-size: 20px;"><br />
        <b>EntryWay</b><br />
    </p>
</div>

<table style="width:100%;">
    <thead>
        <tr>
            <th class="header">No</th>
            <th class="header">Reg No</th>
            <th class="header">Names</th>
            <th class="header">Phone</th>
            <th class="header" style="padding: 0 55px;">Faculty</th>
            <th class="header">Department</th>
            <th class="header">Session</th>
            <th class="header">Gate</th>
            <th class="header" style="padding: 0 45px;">Date & Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        $sql = "SELECT * FROM tbl_access_control WHERE DATE_FORMAT(timein, '%Y-%m-%d') BETWEEN '" . $dateFrom . "' AND '" . $dateTo . "'";
        $query = $DB_ICON->prepare($sql);
        $query->execute();

        while ($fetch = $query->fetch()) {
            $no += 1;
            $regno = $fetch['regno'];
            $camp = $fetch['staff_get_id'];

            $sqlget = $DB_ICON->prepare("SELECT * FROM tbl_place WHERE place_id = '" . $camp . "'");
            $sqlget->execute();
            $rows = $sqlget->fetch();
            $place = $rows['place_name'];

            $stsql = " SELECT * FROM students WHERE registration_number = '" . $regno . "' ";
            $stquery = $Db_Api->prepare($stsql);
            $stquery->execute();
            $stfetch = $stquery->fetch();

            // 		faculty
            $fac = $stfetch['faculity_id'];
            $facsql = " SELECT * FROM faculities where id=$fac";
            $facquery = $Db_Api->prepare($facsql);
            $facquery->execute();
            $facfetch = $facquery->fetch();

            //      department
            $dept = $stfetch['department_id'];
            $deptsql = " SELECT * FROM departments where id=$dept";
            $deptquery = $Db_Api->prepare($deptsql);
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
            <td><?php echo $fetch['timein']; ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>