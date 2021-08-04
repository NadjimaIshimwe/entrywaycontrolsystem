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

// UPDATE PROFILE ONLY

if (isset($_POST['btn_update'])) {
    try {
        $place_id = $_POST['place_id'];
        $place_name = $_POST['place_name'];
        $mobile_no = $_POST['mobile_no'];

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE `tbl_place` SET `place_name` = '$place_name',`mobile_no` = '$mobile_no' WHERE `place_id` = '$place_id' ";
        $conn->exec($sql);

        $pdo_crud = "UPDATE `tbl_users_login` SET `username` = '$place_name' WHERE `user_id` = '$place_id' and `role_id` = '2'";
        $conn->exec($pdo_crud);

        echo '<script language="javascript">
                        alert("Successfully Updated Check Point ");
                        window.location.href = "check_point.php";
                        </script>';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// UPDATE SETTINGS

if (isset($_POST['update_settings'])) {
    try {
        $login_id = $_POST['login_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $new_pass = md5($password);

        $sql_2 = $conn->prepare(" SELECT * FROM `tbl_users_login` WHERE login_id='$login_id' ");
        $sql_2->execute();
        while ($fetch_2 = $sql_2->fetch()) {
            $username_check = $fetch_2['username'];
            $password_check = $fetch_2['password'];
        }

        if (($username == $username_check) and ($new_pass == $password_check)) {

            echo '<script language="javascript">
                        alert(" Sorry Try Changing Password Or Username ");
                        window.location.href = "check_point.php";
                    </script>';
        } else if (($username != $username_check) and ($new_pass == $password_check)) {

            $pdo_crud = "UPDATE `tbl_users_login` SET `username` = '$username' WHERE `login_id` = '$login_id' ";
            $conn->exec($pdo_crud);


            $msg = " Credentials Reset successfully , Your new username :$username , The Password is not changed ";

            echo '<script language="javascript">
                        alert(" Username Successfully Changed ");
                        window.location.href = "check_point.php";
                    </script>';
        } else if (($username == $username_check) and ($new_pass != $password_check and $new_pass != '')) {

            $pdo_crud = "UPDATE `tbl_users_login` SET `password` = '$new_pass' WHERE `login_id` = '$login_id' ";
            $conn->exec($pdo_crud);

            $msg = " Credentials Reset successfully , Your New Password :$password , The Username is not changed ";

            echo '<script language="javascript">
                        alert(" Password Successfully Changed ");
                        window.location.href = "check_point.php";
                    </script>';
        } else if (($username != $username_check) and ($new_pass != $password_check)) {

            $pdo_crud = "UPDATE `tbl_users_login` SET `username` = '$username',`password` = '$new_pass' WHERE `login_id` = '$login_id' ";
            $conn->exec($pdo_crud);

            $msg = " Credentials Reset successfully , Your New Username : $username And  Password : $password ";

            echo '<script language="javascript">
                        alert(" Username  And Password Successfully Changed ");
                        window.location.href = "check_point.php";
                    </script>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<?php
$place_id = $_GET['place_id'];

$sql_1 = $conn->prepare(" SELECT * FROM `tbl_users_login` WHERE user_id='" . $place_id . "' AND role_id='2' ");
$sql_1->execute();
while ($fetch = $sql_1->fetch()) {
    $username = $fetch['username'];
    $login_id = $fetch['login_id'];
}


$sql = $conn->prepare("SELECT * FROM `tbl_place` WHERE `place_id` = '" . $_GET['place_id'] . "'");
$sql->execute();
while ($fetch = $sql->fetch()) {
    $place_id = $fetch['place_id'];
?>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            EDIT CHECK POINT
                        </h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#profile_only_icon_title" data-toggle="tab" aria-expanded="false">
                                    <i class="material-icons">account_circle</i>
                                </a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#settings_only_icon_title" data-toggle="tab" aria-expanded="true">
                                    <i class="material-icons">settings</i>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="profile_only_icon_title">
                                <b>Profile Content</b>
                                <p>
                                <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <div class="col-lg-8">

                                            <div class="row clearfix">
                                                <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="">Check Point Name</label>
                                                </div>
                                                <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="hidden" class="form-control" name="place_id"
                                                                value="<?php echo $place_id ?>" required>
                                                            <input type="text" class="form-control" name="place_name"
                                                                value="<?php echo $fetch['place_name'] ?>" required>
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
                                                            <input type=" number" class="form-control" name="mobile_no"
                                                                value="<?php echo $fetch['mobile_no'] ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div
                                                    class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                    <button type="submit" name="btn_update"
                                                        class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                                    <a href="check_point.php"><label
                                                            class="btn btn-primary m-t-15 waves-effect">Cancel</label></a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="settings_only_icon_title">
                                <b>Settings Content</b>
                                <p>
                                <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <div class="col-lg-8">

                                            <div class="row clearfix">
                                                <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="">Username</label>
                                                </div>
                                                <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="hidden" class="form-control" name="login_id"
                                                                value="<?php echo $login_id ?>" required>
                                                            <input type="text" class="form-control" name="username"
                                                                value="<?php echo $username; ?>" required>
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
                                                            <input type="text" class="form-control" name="password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div
                                                    class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                    <button type="submit" name="update_settings"
                                                        class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                                    <a href="check_point.php"><label
                                                            class="btn btn-primary m-t-15 waves-effect">Cancel</label></a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                </form>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    </div>
    </div>
</section>

<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result)
                .width('100%')
                .height(200);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php include('../includes/js.php'); ?>
</body>

</html>