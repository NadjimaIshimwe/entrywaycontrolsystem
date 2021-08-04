<?php
include 'includes/header.php';
include('./links.php');

//Starting Query...

if (isset($_POST['sign_up'])) {
    $sql_check = $db->prepare("SELECT * FROM tbl_user WHERE mobile_no=? || id_no=?");
    try {
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $mob_no = $_POST['mob_no'];
        $id_no = $_POST['id_no'];
        $stuffs = $_POST['stuffs'];
        $luggages = $_POST['luggages'];
        $user_type = $_POST['user_type'];
        $place_id = $_POST['user_type'];
        $status = '1';

        $sql_check->execute(array($mob_no, $id_no));
        $row_count_check = $sql_check->rowCount();
        if ($row_count_check >= 1) {
            $snap_msg = "Mobile number or ID have been taken!";
        } else {
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $reg_date = date("Y-m-d H:i:s");

            $sql = $db->prepare("INSERT INTO `tbl_user` (`f_name`, `l_name`,`mobile_no`, `id_no`, `user_type`)
                VALUES ('$f_name', '$l_name', '$mob_no','$id_no', '$user_type')");
            if ($sql->execute()) {
                $userId = $db->lastInsertId();
                $sql2 = $db->prepare("INSERT INTO `tbl_records` (`user_id`, `place_id`,`entrance_time`, `stuffs`, `rec_date`)
                VALUES ('$userId', '$l_name', '$mob_no','$id_no', '$user_type')");
                $sql2->execute();
                $msg = "Sign Up done Successfully!";
            }
        }
    } catch (PDOException $e) {
        $snap_msg = "Something went wrong!!!";
    }
}
?>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a><img src="images/entry_logo_only.png"
                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: contain;"></a><br>
            <small>
                <h3>Sign Up</h3>
            </small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST" action="" enctype="multipart/form-data">
                    <div class="msg">
                        <?php if (isset($msg)) { ?>
                        <div class="alert bg-green left-icon-alert " role="alert">
                            <strong>Well done! </strong><?php echo htmlentities($msg); ?> <br />
                            <a href="index.php"> Use Mobile.no to Sign-in as username & password.</a>
                        </div>
                        <?php
                            echo '<meta http-equiv="refresh"' . 'content="3;URL=index.php">';
                        }
                        ?>

                        <?php if (isset($snap_msg)) { ?>
                        <div class="alert bg-red left-icon-alert " role="alert">
                            <strong>OOOHH SNAP!</strong><?php echo htmlentities($snap_msg); ?> <br />
                            <a href="sign-up.php"> Use another one.</a>
                        </div>
                        <?php
                            echo '<meta http-equiv="refresh"' . 'content="3;URL=sign-up.php">';
                        }
                        ?>

                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="f_name" placeholder="First Name" required
                                autofocus>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="l_name" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="mob_no" maxlength="15"
                                placeholder="Mobile no." required>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">credit_card</i>
                        </span>
                        <div class="form-line">
                            <input type="text" data-plugin-selectTwo class="form-control populate" name="id_no"
                                placeholder="ID No. [Indangamuntu]" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">computer</i>
                        </span>
                        <div class="form-line">
                            <input type="text" data-plugin-selectTwo class="form-control populate" name="stuffs"
                                placeholder="serial number" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">luggage</i>
                        </span>
                        <div class="form-line">
                            <input type="text" data-plugin-selectTwo class="form-control populate" name="luggages"
                                placeholder="other stuffs(name:ID separated by comma)">
                        </div>
                    </div>

                    <div class="input-group">
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

                    <button btype="submit" name="sign_up" class="btn btn-block btn-lg bg-pink waves-effect">SIGN
                        UP</button>

                    <!--Province-->

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="index.php">Already Registered ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php include('./js.php'); ?>
</body>

</html>