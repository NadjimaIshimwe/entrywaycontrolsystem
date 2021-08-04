<?php
include('../includes/header.php');
include('../includes/links.php');
?>


<?php include('../includes/top_bar.php'); ?>

<script type="text/javascript">
$(document).ready(function() {

    $("#gate_id").change(function() {
        $("#loader_cont").after(
            '<div id="loader"><img src="images/ajax_loader.gif" alt="loading...." width="10" height="10" /></div>'
        );
        $.get('load_date_from.php?gate_id=' + $(this).val(), function(data) {
            $("#date_from").html(data);
            $('#loader').slideUp(910, function() {
                $(this).remove();
            });
        });
    });

});
</script>

<style type="text/css">
.form-group {
    margin-bottom: 15px;
}
</style>

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

        <!-- #Start# Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            General Entrance Report
                        </h2>

                    </div>

                    <div class="body">
                        <form class="form" method="POST" action="general_report_results">
                            <div class="row clearfix">

                                <div class="col-md-4">
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-4 form-control-label">
                                            <label for="email_address_2">Check Point</label>
                                        </div>
                                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-group" id="loader_cont">
                                                    <select id="gate_id" name="schedule" class="form-control select2"
                                                        data-placeholder="Select Gate">
                                                        <option value="">--Choose Point--</option>
                                                        <?php
                                                        $stmt = $conn->prepare(" SELECT tbl_place.place_id,tbl_place.place_name FROM tbl_place ");
                                                        $stmt->execute();
                                                        try {
                                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <option value="<?php echo $row['place_id']; ?>">
                                                            <?php echo $row['place_name']; ?></option>

                                                        <?php
                                                            }
                                                        } catch (PDOException $ex) {
                                                            //Something went wrong rollback!

                                                            echo $ex->getMessage();
                                                        }
                                                        ?>
                                                        <option value="all_check">All Check Points</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div name='date_from' id='date_from'>

                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Horizontal Layout -->

    </div>
</section>

<?php include('../includes/js.php'); ?>
</body>

</html>