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
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                GetAccess Software
                <small> Manage <a> [Student Entrance]</a></small>
            </h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-sm-6 mt-md">
                                <i class="fa fa-refresh"></i> Protestant Institute of Arts and Social Sciences
                            </div>
                            <div class="col-sm-6 text-right mt-md mb-md">
                                <h5 class="h4 m-none text-dark text-bold"> <a href="#"
                                        onclick="window.location.reload(true);"><b><i class="fa fa-file"></i> Student
                                            Report</b></a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-body">
                                <div class="tab-pane fade in active" id="general_report"><br />

                                    <form action="" method="POST" name="checkDate">
                                        <div class="row clearfix">

                                            <div class="col-md-1 my-auto">
                                            </div>

                                            <label class="col-md-2">Date From <span class="text-danger">*</span></label>
                                            <div class="col-md-3">
                                                <input type="date" name="dateFrom" id="dateFrom" class="form-control"
                                                    placeholder="dd-mm-yyyy" required>
                                            </div>

                                            <label class="col-md-2">Date To <span class="text-danger">*</span></label>
                                            <div class="col-md-3">
                                                <input type="date" name="dateTo" id="dateTo" class="form-control"
                                                    placeholder="dd-mm-yyyy" required>
                                            </div>

                                        </div>
                                    </form>

                                </div>

                            </div>

                            <div id="display_contents"></div>

                        </div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->

    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {

    $("#dateTo").change(function() {
        var dateFrom = $('#dateFrom').val();
        $(this).after(
            '<div id="loader"><img src="../images/loading.gif" alt="loading...." width="30" height="30" /></div>'
            );
        $.get('load_rptstdntEntce.php?dateTo=' + $(this).val() + '&dateFrom=' + dateFrom, function(
        data) {
            $("#display_contents").html(data);
            $('#loader').slideUp(910, function() {
                $(this).remove();
            });
        });
    });

});
</script>
<?php include('../includes/js.php'); ?>
</body>

</html>