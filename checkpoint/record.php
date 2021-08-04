<?php
include('../includes/header.php');
include('../includes/links.php');
?>

<?php
$sql = $conn->prepare(" SELECT * FROM `tbl_place` WHERE `place_id` = '" . $_SESSION['user_id'] . "'  ");
$sql->execute();
while ($fetch = $sql->fetch()) {
    $place_id = $fetch['place_id'];
    $place_name = $fetch['place_name'];
}

if (isset($_POST['btn_save_cheq_point'])) {
    $sql_check = $conn->prepare("SELECT * FROM tbl_user WHERE mobile_no=? or id_no=?");
    try {
        $fname = $_POST['f_name'];
        $lname = $_POST['l_name'];
        $mobile_no = $_POST['mob_no'];
        $id_no = $_POST['id_no'];
        $stuffs = $_POST['stuffs'];
        $luggages = $_POST['luggages'];
        $all_stuffs = $luggages == "" ? $stuffs : $stuffs . ',' . $luggages;
        $user_type = $_POST['user_type'];

        $sql_check->execute(array($mobile_no, $id_no));
        $row_count_check = $sql_check->rowCount();
        if ($row_count_check >= 1) {
            $snap_msg = "Mobile number or ID have been recorded before!";
        } else {

            //Register user
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $role_id = '2';
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `tbl_user` (`f_name`,`l_name`,`mobile_no`,`id_no`, `user_type`)
    			VALUES ('$fname','$lname','$mobile_no','$id_no', '$user_type')";
            $conn->exec($sql);
            $lastId = $conn->lastInsertId();

            $pdo_crud = "INSERT INTO `tbl_records` (`user_id`,`place_id` ,`entrance_time`, `stuffs`, `rec_date`)
        		VALUES ('$lastId', '$place_id', '$time','$all_stuffs','$date')";
            $conn->exec($pdo_crud);
            $msg = "Added Successfully!";
            echo '<script language="javascript">
                    alert("' . $fname . ' ' . $lname . '  Successfully Added ");
                    window.location.href = "record.php";
                </script>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<style>
button {
    border: none;
    background-color: transparent;
}

.grid {
    height: 23px;
    position: relative;
    bottom: 4px;
}

.signbutton {
    background-color: #71110f;
    color: #fff;
    border: none;
    border-radius: 3px;
    margin-top: 10px;
    padding: 7px 10px;
    position: relative;
    bottom: 7px;
    font-weight: bold;
}

.logo {
    margin-top: 60px;
    margin-bottom: 20px;
}

.bar {
    margin: 0 auto;
    width: 575px;
    border-radius: 30px;
    border: 1px solid #dcdcdc;
}

.bar:hover {
    box-shadow: 1px 1px 8px 1px #dcdcdc;
}

.bar:focus-within {
    box-shadow: 1px 1px 8px 1px #dcdcdc;
    outline: none;
}

.searchbar {
    height: 43px;
    border: none;
    width: 500px;
    font-size: 16px;
    outline: none;

}

.voice {
    height: 20px;
    position: relative;
    top: -2px;
}

.buttons {
    margin-top: 30px;
}

.button {
    background-color: #f5f5f5;
    border: none;
    color: #707070;
    font-size: 15px;
    padding: 10px 20px;
    margin: 5px;
    border-radius: 4px;
    outline: none;
}

.button:hover {
    border: 1px solid #c8c8c8;
    padding: 9px 19px;
    color: #808080;
}

.button:focus {
    border: 1px solid #4885ed;
    padding: 9px 19px;
}

@media screen and (max-width: 400px) {
    .bar {
        width: 320px;
        max-width: inherit;
    }

    .searchbar {
        width: 256px;
        margin-left: 18px;
    }

    .logo {
        margin-top: 100px;
        margin-bottom: 20px;
    }
}

@media screen and (max-width: 360px) {
    .bar {
        width: 300px;
        max-width: inherit;
    }

    .searchbar {
        width: 260px;
    }

    .logo {
        margin-top: 148px;
        margin-bottom: 20px;
    }

    .chur_data {
        margin-left: 5px !important;
    }

    .advert {
        margin-left: 5px !important;
        display: none;
    }

    .chms {
        margin-left: 52px !important;
        float: none !important;
        height: 83px;
    }
}

@media screen and (max-width: 400px) {
    .bar {
        width: 320px;
        max-width: inherit;
    }

    .searchbar {
        width: 260px;
    }

    .logo {
        margin-top: 148px;
        margin-bottom: 20px;
    }

    .chur_data {
        margin-left: 5px !important;
    }

    .advert {
        margin-left: 5px !important;
        display: none;
    }

    .chms {
        margin-left: 60px;
        float: none !important;
        height: 83px;
    }
}

@media screen and (max-width: 415px) {
    .bar {
        width: 360px;
        max-width: inherit;
    }

    .searchbar input {
        width: 277px;
        margin-left: 18px;
    }

    .logo {
        margin-top: 100px;
        margin-bottom: 20px;
    }

    .chur_data {
        margin-left: 5px !important;
    }

    .advert {
        margin-left: 5px !important;
        display: none;
    }

    .chms {
        margin-left: 78px;
        float: none !important;
        height: 69px !important;
    }
}

@media screen and (max-width: 565px) {
    .bar {
        width: 280px;
        max-width: inherit;
    }

    .searchbar {
        width: 209px;
        margin-left: 18px;
    }

    .logo {
        margin-top: 100px;
        margin-bottom: 20px;
    }

    .chur_data {
        margin-left: 5px !important;
    }

    .advert {
        margin-left: 5px !important;
        display: none;
    }
}
</style>

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

        <!-- Alert message -->
        <?php if (isset($msg)) { ?>
        <div class="alert bg-green alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
        </div>
        <?php } ?>

        <?php if (isset($snap_msg)) { ?>
        <div class="alert bg-red alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <strong>Oops!</strong> <?php echo htmlentities($snap_msg); ?>
        </div>
        <?php } ?>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Search Person
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button class="btn btn-primary" data-toggle="modal"
                                    data-target=".bs-example-modal-sm">Add New</button>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <!-- Testing Data-->

                        <center>

                            <div class="bar">
                                <div class="autocomplete">
                                    <form method="POST" action="">
                                        <input class="searchbar" type="text" title="Search" id="search" name="tel"
                                            placeholder="Search By Mobile or ID" required>
                                        <button type="submit">
                                            <img class="voice" src="../images/search.png"
                                                title="Search By Mobile or ID">
                                        </button>
                                    </form>

                                </div>
                            </div>

                        </center>
                        <?php

                        if (!empty($_POST['tel'])) {
                            $tel = $_POST['tel'];
                            $sql_users = " SELECT * FROM tbl_user, tbl_user_type WHERE tbl_user.user_type = tbl_user_type.id and mobile_no='$tel' or id_no='$tel' ";
                            $query_users = $conn->prepare($sql_users);
                            $query_users->execute();
                            $data_users = $query_users->rowCount();
                            $fetch_user = $query_users->fetch();

                            $sql = " SELECT * FROM tbl_records, tbl_user, tbl_user_type WHERE tbl_user.user_id = tbl_records.user_id and mobile_no='$tel' or id_no='$tel' and tbl_user.user_type=tbl_user_type.id order by rec_id desc limit 1 ";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            $data = $query->rowCount();

                            $fetch = $query->fetch();
                            $rec_id = $fetch['rec_id'];
                            $user_id = $fetch['user_id'];
                            $f_sname = $fetch['f_name'];
                            $l_sname = $fetch['l_name'];
                            $mobile_sno = $fetch['mobile_no'];
                            $id_sno = $fetch['id_no'];
                            $stuffs = $fetch['stuffs'];
                            $user_type_name = $fetch['name'];
                            if ($data > 0 && empty($fetch['exit_time']) && ($fetch['rec_date'] == date("Y-m-d"))) {
                        ?>
                        <hr />

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h4>
                                    <center>
                                        Person Found (<i><?php echo $user_type_name; ?></i>)
                                    </center>
                                </h4>
                                <div class="row">
                                    <form class="form-horizontal" method="POST" action="entrance_record.php">

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <div class="form-line">
                                                    <span class="form-control"><?php echo $f_sname; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <div class="form-line">
                                                    <span class="form-control"><?php echo $l_sname; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                                <div class="form-line">
                                                    <span class="form-control"><?php echo $mobile_sno; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">contact_mail</i>
                                                </span>
                                                <div class="form-line">
                                                    <span class="form-control"><?php echo $id_sno; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">access_time</i>
                                                </span>
                                                <div class="form-line">
                                                    <span class="form-control"
                                                        id="prev-luggs"><?php echo $fetch['entrance_time']; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">computer</i>
                                                </span>
                                                <div class="form-line">
                                                    <span class="form-control"
                                                        id="prev-luggs"><?php echo $stuffs == "" ? "nothing" : $stuffs; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="display:none;">
                                                <input type="text" class="form-control" name="scan_result"
                                                    value="<?php echo $rec_id; ?>" required />
                                                <input type="text" class="form-control" name="place_id"
                                                    value="<?php echo $place_id; ?>" required />
                                            </div>
                                            <center>
                                                <button type="submit" name="confirm_leave"
                                                    class="btn btn-danger">Confirm
                                                    Leave</button>
                                            </center>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                            } else if ($data > 0 || $data_users > 0) {
                            ?>
                        <hr>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h4>
                                    <center>
                                        Person Found
                                        (<i><?php echo ($user_type_name ? $user_type_name : $fetch_user['name']); ?></i>)
                                    </center>
                                </h4>
                                <div class="row">
                                    <form class="form-horizontal" method="POST" action="entrance_record.php">

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <div class="form-line">
                                                    <span
                                                        class="form-control"><?php echo ($f_sname ? $f_sname : $fetch_user['f_name']); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span>
                                                <div class="form-line">
                                                    <span
                                                        class="form-control"><?php echo ($l_sname ? $l_sname : $fetch_user['l_name']); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                                <div class="form-line">
                                                    <span
                                                        class="form-control"><?php echo ($mobile_sno ? $mobile_sno : $fetch_user['mobile_no']); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">contact_mail</i>
                                                </span>
                                                <div class="form-line">
                                                    <span
                                                        class="form-control"><?php echo ($id_sno ? $id_sno : $fetch_user['id_no']); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                                echo $data_users < 1 ? "" :
                                                    '<div class="col-md-1">
                                            <div class="input-group">
                                                <div class="form-line">
                                                    <input type="checkbox" id="toggle-luggs" class="form-control"
                                                        style="left: 0; opacity: 1;" checked />
                                                </div>
                                            </div>
                                        </div>';
                                                ?>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">computer</i>
                                                </span>
                                                <div class="form-line">
                                                    <?php
                                                            if ($data_users > 0) {
                                                            ?>
                                                    <span class="form-control"
                                                        id="prev-luggs"><?php echo $stuffs; ?></span>
                                                    <input type="text" id="luggs" class="form-control" name="stuffs"
                                                        style="display: none;"
                                                        placeholder="Other stuffs(name:ID seprated by comma)" />
                                                    <?php
                                                            } else {
                                                            ?>
                                                    <input type="text" id="luggs" class="form-control" name="stuffs"
                                                        placeholder="Serial number" />
                                                    <?php
                                                            }
                                                            ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div style="display:none;">
                                                <input type="text" class="form-control" name="scan_result"
                                                    value="<?php echo $rec_id; ?>" />
                                                <input type="text" class="form-control" name="userId"
                                                    value="<?php echo $fetch_user['user_id']; ?>" />
                                                <input type="text" class="form-control" name="place_id"
                                                    value="<?php echo $place_id; ?>" required />
                                            </div>
                                            <center>
                                                <button type="submit" name="make_record" class="btn btn-primary">Make
                                                    Record</button>
                                            </center>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                            } else {
                            ?>
                        <center>
                            <br>
                            <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                No Data Available
                            </div>
                        </center>
                        <?php

                            }
                        } else {
                            ?>

                        <?php
                        }
                        ?>
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
                            <input type="text" class="form-control" name="f_name" required autofocus>
                            <label class="form-label">First Name</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="l_name" required>
                            <label class="form-label">Last Name</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="mob_no" maxlength="15" required>
                            <label class="form-label">Mobile no.</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" data-plugin-selectTwo class="form-control populate" name="id_no"
                                required>
                            <label class="form-label">ID No. [Indangamuntu]</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" data-plugin-selectTwo class="form-control populate" name="stuffs"
                                required>
                            <label class="form-label">serial number</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" data-plugin-selectTwo class="form-control populate" name="luggages">
                            <label class="form-label">other stuffs(name:ID separated by comma)</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <select name="user_type" class="form-control select2" data-placeholder="Select Gate">
                            <?php
                            $stmt = $conn->prepare(" SELECT * FROM tbl_user_type ");
                            $stmt->execute();
                            try {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row['name'] == 'Student') {
                            ?>
                            <option value="<?php echo $row['id']; ?>" selected><?php echo $row['name']; ?></option>
                            <?php
                                    } else {
                                    ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                            <?php
                                    }
                                }
                            } catch (PDOException $ex) {
                                //Something went wrong rollback!

                                echo $ex->getMessage();
                            }
                            ?>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="btn_save_cheq_point" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php include('../includes/js.php'); ?>

<script>
let toggleLuggs = $('#toggle-luggs');
let prevLuggs = $('#prev-luggs');
let luggs = $('#luggs');
toggleLuggs.on('click', (e) => {
    if (toggleLuggs.is(":checked") == true) {
        prevLuggs.show();
        luggs.hide();
        luggs.val(prevLuggs.val());
    } else {
        prevLuggs.hide();
        luggs.show().focus();
    }
})
</script>
</body>

</html>