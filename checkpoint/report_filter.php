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
            <h2>Report</h2>
        </div>

        <!-- #Start# Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Report Filters
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
                        <form class="form" method="POST" action="report_search_result.php">
                            <div class="row clearfix">

                                <div class="col-lg-4">
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-4 form-control-label">
                                            <label for="email_address_2">Date From</label>
                                        </div>
                                        <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="date" class="form-control" name="from">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-4 form-control-label">
                                            <label for="email_address_2">Date To</label>
                                        </div>
                                        <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="date" class="form-control" name="to">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="row clearfix">
                                        <div class="form-group">
                                            <button type="submit" name="search_report"
                                                class="btn btn-primary m-l-15 waves-effect"> SUBMIT DATA </button>
                                        </div>
                                    </div>
                                </div>

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