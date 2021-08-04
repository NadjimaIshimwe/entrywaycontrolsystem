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
if (isset($_POST['btn_update'])) {
    try {
        $admin_id = $_POST['admin_id'];
        $admin_name = $_POST['admin_name'];
        $mobile = $_POST['mobile'];
        $passcode = $_POST['passcode'];

        if (empty($passcode)) {

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `tbl_admin` SET `admin_name` = '$admin_name',`adm_mobile` = '$mobile' WHERE `admin_id` = '$admin_id' ";
            $conn->exec($sql);

            echo '<script language="javascript">
                        alert("Successfully Updated Settings ");
                        window.location.href = "settings.php";
                        </script>';

            //Update to User Login Account//

            $pdo_crud = "UPDATE `tbl_users_login` SET `username` = '$admin_name' WHERE `user_id` = '$admin_id' AND role_id='1' ";
            $conn->exec($pdo_crud);
        } else if (!empty($passcode)) {

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `tbl_admin` SET `admin_name` = '$admin_name',`adm_mobile` = '$mobile' WHERE `admin_id` = '$admin_id' ";
            $conn->exec($sql);

            //Update to User Login Account//
            $new_password_encrypted = md5($passcode);

            $pdo_crud = "UPDATE `tbl_users_login` SET `username` = '$admin_name',`password` = '$new_password_encrypted' WHERE `user_id` = '$admin_id' AND role_id='1' ";
            $conn->exec($pdo_crud);

            echo '<script language="javascript">
                        alert("Successfully Updated Settings ");
                        window.location.href = "../logout.php";
                        </script>';
        } else {
            echo '<script language="javascript">
                        alert(" Something Went Wrong ");
                        window.location.href = "settings.php";
                    </script>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<?php
$admin_id = $_SESSION['user_id'];
$sql = $conn->prepare("SELECT * FROM `tbl_admin` WHERE `admin_id` = '$admin_id' ");
$sql->execute();
while ($fetch = $sql->fetch()) {
    $admin_id = $fetch['admin_id'];
    $admin_status = $fetch['status'];
    $type = $fetch['adm_type'];
?>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            MY PROFILE
                        </h2>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-lg-8">

                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="">Name</label>
                                        </div>
                                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="hidden" class="form-control" name="admin_id"
                                                        value="<?php echo $admin_id ?>" required>
                                                    <input type="text" class="form-control" name="admin_name"
                                                        value="<?php echo $fetch['admin_name'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="">Mobile No.</label>
                                        </div>
                                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type=" number" class="form-control" name="mobile"
                                                        value="<?php echo $fetch['adm_mobile'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="">New Password</label>
                                        </div>
                                        <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="passcode">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                    <button type="submit" name="btn_update"
                                        class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                    <a href="manage_admin.php"><label
                                            class="btn btn-primary m-t-15 waves-effect">Cancel</label></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    </div>
    </div>
</section>
<?php include('../includes/js.php'); ?>
</body>

</html>