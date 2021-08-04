<?php
ob_start();
include 'includes/header.php';

// Randomly generate code.
function sessioncode()
{
    $chars = "003232303232023232023456789";
    srand((float)microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i <= 7) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;
    }
    return $pass;
}
$scode = '' . sessioncode();
$sess_id = md5($scode);

if (!empty($_POST["remember"])) {
    setcookie("login-username", $_POST["login-username"], time() + 3600);
    setcookie("login-password", $_POST["login-password"], time() + 3600);
    // 	echo "Cookies Set Successfuly";
} else {
    setcookie("login-username", "");
    setcookie("login-password", "");
    // 	echo "Cookies Not Set";
}

if (isset($_POST['loginbtn'])) {
    if ($_POST['login-username'] != "" || $_POST['login-password'] != "") {
        $username = $_POST['login-username'];

        $password = $_POST['login-password'];

        $password = md5($_POST["login-password"]);

        $status = '1';
        $tm = date("Y-m-d H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql = "SELECT * FROM `tbl_users_login` WHERE `username`=? AND `password`=? AND status_login=?";
        $query = $conn->prepare($sql);
        $query->execute(array($username, $password, $status));
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if ($row > 0) {

            //Variable session
            $_SESSION['login_id'] = $fetch['login_id'];
            $_SESSION['role'] = $fetch['role_id'];
            $_SESSION['sess_id'] = $sess_id;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $fetch['user_id'];
            $_SESSION['status'] = 'ON';
            $_SESSION['online'] = 'Online';


            //Condition to directory path..
            if ($_SESSION['role'] == 1) {

                header("location: main-campus/"); //Main campus
            } elseif ($_SESSION['role'] == 2) {

                header("location: checkpoint/"); // CHECKPOINT

            } elseif ($_SESSION['role'] == 4) {

                header("location: upanel/"); // USERS

            } elseif ($_SESSION['role'] == 5) {

                header("location: ict-panel/"); // CARD Operator

            } elseif ($_SESSION['role'] == 6) {

                header("location: GetAccess/"); // GETACCESS
            } else {

                header("location: index.php"); // DEFAULT
            }
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `tbl_user_session` VALUES ('', '$sess_id', '$username', '$ip', '$tm','','$_SESSION[status]')";
            $conn->exec($sql);
        } else {

            $msg = "Your username or password is incorrect!";
            header('Location:index.php?msg=' . $msg);
            // echo "
            // <script>alert('User data does not exists!.')</script>
            // <script>window.location = 'index.php'</script>
            // ";
        }
    } else {
        echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
    }
}
ob_end_flush();