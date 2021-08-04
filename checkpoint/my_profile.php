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
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">
                        <div class="image-area">
                            <?php

                            $sql = " SELECT * FROM tbl_place WHERE tbl_place.place_id='$place_id' ";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            while ($fetch = $query->fetch()) {
                                $place_id = $fetch['place_id'];
                                $place_name = $fetch['place_name'];
                                $mobile_no = $fetch['mobile_no'];
                            }
                            ?>
                            <img src="../images/avatar5.png" width="150" height="150" alt="User" />
                        </div>
                        <div class="content-area">
                            <h4><?php echo $place_name; ?></h4>
                            <p>Tel: <?php echo $mobile_no; ?></p>
                            <p>Check Point</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#profile_settings"
                                        aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="profile-body">
                                                <div class="image-area">

                                                    <?php

                                                    if (empty($tech_picture)) {
                                                    ?>
                                                    <img class="align-self-center  mr-3" src="../images/avatar5.png"
                                                        id="blah" alt="<?php echo $tech_names ?>" width="220px"
                                                        height="220px">
                                                    <?php
                                                    } else {
                                                        $fileName = "$tech_picture";
                                                    ?>
                                                    <img class="align-self-center  mr-3"
                                                        src="technite_profile_photos/<?php echo $fileName ?>" id="blah"
                                                        alt="<?php echo $staff_names ?>" width="220px" height="220px">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="image-area">

                                            </div>
                                        </div>
                                        <div class="col-lg-8">

                                            <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">Username</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <span class="form-control"> <?php echo $_SESSION['username']; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">Names</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <span class="form-control"> <?php echo $place_name ?> </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="NameSurname"
                                                    class="col-sm-2 control-label">Telephone</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <span class="form-control"> <?php echo $mobile_no ?> </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('../includes/js.php'); ?>
</body>

</html>