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

// Delete ....
if (isset($_GET['delete_place'])) {
    $sql = $conn->prepare("DELETE from `tbl_place` WHERE `place_id`='" . $_GET['delete_place'] . "' ");
    $sql->execute();
    $mssg = " " . $_GET['place_name'] . " is successfully Removed";
    echo '<meta http-equiv="refresh"' . 'content="1;URL=check_point.php">';
}

if (isset($_POST['btn_save_sub_cheq_point'])) {
    $sql_check = $conn->prepare("SELECT * FROM tbl_place WHERE mobile_no=?");
    try {
        $parent_id = $_POST['parent_id'];
        $place_name = $_POST['place_name'];
        $mobile_no = $_POST['mob_no'];

        $sql_check->execute(array($mobile_no));
        $row_count_check = $sql_check->rowCount();
        if ($row_count_check >= 1) {
            $snap_msg = "Mobile number have been taken!";
        } else {

            //Register sub Checkpoint place
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $role_id = '2';
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `tbl_place` (`place_name`, `mobile_no`)
    			VALUES ('$place_name', '$mobile_no')";
            $conn->exec($sql);
            $lastId = $conn->lastInsertId();

            $msg = "Registered Successfully!";

            $new_password = $place_name;
            $new_password_encrypted = md5($new_password);
            $status = "1";

            $pdo_crud = "INSERT INTO `tbl_users_login` (`user_id`,`username` ,`password`, `role_id`, `date`)
        		VALUES ('$lastId', '$place_name', '$new_password_encrypted','$role_id','$date')";
            $conn->exec($pdo_crud);

            $msg = " Dear $place_name you have registered to EntryWay Control System. Login Username: $mobile_no Password: $new_password. More info,Tel :0788888888.";
            echo '<script language="javascript">
                    alert(" Check Point ' . $place_name . '  Successfully Registered ");
                    window.location.href = "check_point.php";
                </script>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
    header('location: check_point.php');
}

?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                MY CHECK POINT(S)
            </h2>
        </div>

        <!-- Alert message -->
        <?php if (isset($mssg)) { ?>
        <div class="alert bg-red alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <strong>Well done!</strong><?php echo htmlentities($mssg); ?>
        </div>
        <?php } ?>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm"> <i
                                class="fa fa-plus-circle"></i> Add</button>
                    </div>

                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                                <thead class="">
                                    <tr>
                                        <th>No</th>
                                        <th>Names</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                    $no = 0;
                                    $sql = "SELECT * FROM tbl_place";
                                    $query = $conn->prepare($sql);
                                    $query->execute();

                                    while ($fetch = $query->fetch()) {
                                        $place_id = $fetch['place_id'];
                                        $place_name = $fetch['place_name'];
                                        $no += 1;

                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $place_name ?></td>
                                        <td><?php echo $fetch['mobile_no'] ?></td>
                                        <td>
                                            <a href="check_point_edit.php?place_id=<?php echo $place_id; ?>"
                                                title="Edit Check Point"
                                                onclick="if(!confirm('Do you really want to Edit This Check Point?'))return false;else return true;"><i
                                                    class="fa fa-pencil" style="color: #0474fe;"></i>Edit</a>
                                            |
                                            <a href="check_point.php?place&delete_place=<?php echo $place_id; ?>&&place_name=<?php echo $place_name; ?>"
                                                onclick="if(!confirm('Do you really want to Delete This Check Point?'))return false;else return true;"
                                                title="Delete Check Point" class="" style="color: #a61212;"><i
                                                    class="fa fa fa-trash-o" style="color: #a61212;"></i> Delete</a>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

<!-- Modal Data -->

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Check Point Info.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_validation" method="POST" action="">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="hidden" class="form-control" name="parent_id" value="<?php echo $prof_id; ?>"
                                required>
                            <input type="text" class="form-control" name="place_name" required>
                            <label class="form-label">Check Point Name</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="mob_no" required>
                            <label class="form-label">Mobile No.</label>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="btn_save_sub_cheq_point" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php include('../includes/js.php'); ?>
</body>

</html>