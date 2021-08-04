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

            <h2> <?php echo $place_name; ?> DASHBOARD | Check Point Panel </h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <?php
            $today = date("Y-m-d");
            ?>
            <a href="report_search_result.php?from=<?php echo $today; ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">contacts</i>
                        </div>
                        <div class="content">
                            <?php
                            $today = date("Y-m-d");
                            $sql = " SELECT COUNT(*) As people_history FROM tbl_user,tbl_place,tbl_records WHERE tbl_records.user_id=tbl_user.user_id AND tbl_records.place_id=tbl_place.place_id AND tbl_records.place_id ='$place_id' AND tbl_records.rec_date='$today' ";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            while ($fetch = $query->fetch()) {
                                $total_people_history = $fetch['people_history'];
                            }
                            ?>
                            <div class="text">All People</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $total_people_history; ?>"
                                data-speed="1000" data-fresh-interval="20"><?php echo $total_people_history; ?></div>
                        </div>
                    </div>
                </div>
            </a>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">label_off</i>
                    </div>
                    <div class="content">
                        <?php
                        $sql = " SELECT COUNT(*) As no_exit_people FROM tbl_user,tbl_place,tbl_records WHERE tbl_records.user_id=tbl_user.user_id AND tbl_records.place_id=tbl_place.place_id AND tbl_records.exit_time IS NULL AND tbl_records.place_id = '$place_id' AND tbl_records.rec_date='$today'  ";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        while ($fetch = $query->fetch()) {
                            $total_no_exit_people = $fetch['no_exit_people'];
                        }
                        ?>
                        <div class="text">Available People</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo $total_no_exit_people; ?>"
                            data-speed="1000" data-fresh-interval="20"><?php echo $total_no_exit_people; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #Widgets -->

    </div>
</section>


<?php include('../includes/js.php'); ?>
</body>

</html>