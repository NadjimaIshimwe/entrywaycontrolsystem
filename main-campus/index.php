<?php
include('../includes/header.php');
if (!isset($_SESSION['role'])) {
    echo '<meta http-equiv="Refresh" content="0; url=../">';
}
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

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2> DASHBOARD | ADMIN Panel </h2>
            <small>Today's [<a href="javascript:void(0);">Update</a></small>]
        </div>
        <?php
        $today = date("Y-m-d");
        $plc_id = "all_check"
        ?>
        <!-- Widgets -->
        <div class="row clearfix">
            <a
                href="general_report_results.php?from=<?php echo $today; ?>&to=<?php echo $today; ?>&schedule=<?php echo $plc_id; ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">grading</i>
                        </div>
                        <div class="content">
                            <?php

                            // CHECKING MY ALL CHECK POINTS
                            $sql_place_check = " SELECT * FROM tbl_place ";
                            $stmt = $conn->prepare($sql_place_check);
                            $stmt->execute();
                            $array_place = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $total_place = array();
                            $total_records = 0;
                            foreach ($array_place as $row_place) {
                                $total_place[] = $row_place['place_id'];
                            }
                            $total_place_array = implode(',', $total_place);

                            $sql = " SELECT COUNT(*) AS records FROM `tbl_records` WHERE rec_date='$today' AND place_id IN ($total_place_array) ";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            while ($fetch = $query->fetch()) {
                                $total_records = $fetch['records'];
                            }
                            ?>
                            <div class="text">Records Today</div>
                            <div class="number count-to" data-from="<?php echo $total_records; ?>" data-to="0"
                                data-speed="1000" data-fresh-interval="20"><?php echo $total_records; ?></div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
        <!-- #Widgets -->

        <!-- Schedules data of church -->
        <div class="row clearfix">
            <div class="block-header">

                <h2> Today Record's : <?php echo $today; ?> </h2>
            </div>
        </div>
        <div class="row clearfix">
            <?php
            $sql_2 = " SELECT * FROM tbl_place";
            $query_2 = $conn->prepare($sql_2);
            $query_2->execute();
            $sch_data = $query_2->rowCount();
            while ($fetch_2 = $query_2->fetch()) {
                $plc_id = $fetch_2['place_id'];
                $plc_name = $fetch_2['place_name'];
            ?>
            <a
                href="general_report_results.php?from=<?php echo $today; ?>&to=<?php echo $today; ?>&schedule=<?php echo $plc_id; ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">contacts</i>
                        </div>
                        <div class="content">
                            <?php
                                $sql_rec = " SELECT COUNT(user_id) AS tot_people FROM tbl_records WHERE place_id='$plc_id' AND rec_date BETWEEN '$today' AND '$today' ";
                                $query_rec = $conn->prepare($sql_rec);
                                $query_rec->execute();
                                while ($fetch_rec = $query_rec->fetch()) {
                                    $total_people = $fetch_rec['tot_people'];
                                }
                                ?>
                            <div class="text"><?php echo $plc_name; ?></div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_people; ?>"
                                data-speed="1000" data-fresh-interval="20"><?php echo $total_people; ?></div>
                        </div>
                    </div>
                </div>
            </a>
            <?php
            }
            ?>
        </div>
        <!-- End of Schedules data of church -->

    </div>
</section>


<?php include('../includes/js.php'); ?>
</body>

</html>