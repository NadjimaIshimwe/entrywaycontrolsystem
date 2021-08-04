<?php
ob_start();
session_start();
include 'db_controller.php';
$dt = date("Y-m-d");
$tim = date("H:i:s");

// Login user Id
if (!isset($_SESSION) && !isset($_SESSION['role'])) {
    $role_id = $_SESSION['role'];

    // end of user data

    if ($role_id == 1) { // Admin Data

        $sql = " SELECT * FROM tbl_users_login ,tbl_admin WHERE tbl_users_login.login_id='$_SESSION[login_id]' AND tbl_users_login.profile_id=tbl_admin.adminid AND tbl_users_login.role_id='1' ";
        $query = $conn->prepare($sql);
        $query->execute();

        while ($fetch = $query->fetch()) {
            $user_id = $fetch['user_id'];
            $login_id = $fetch['login_id'];
            $f_name = $fetch['f_name'];
            $l_name = $fetch['l_name'];
            $username = $fetch['username'];
            $mobile_no = $fetch['mobile_no'];
            $id_no = $fetch['id_no'];
            $user_status = $fetch['user_status'];
        }
    } else if ($role_id == 2) { // Place Data

        $sql = " SELECT * FROM tbl_users_login, tbl_place WHERE tbl_users_login.login_id='$_SESSION[login_id]' AND tbl_users_login.profile_id=tbl_place.place_id AND tbl_users_login.role_id='2'";
        $query = $conn->prepare($sql);
        $query->execute();

        while ($fetch = $query->fetch()) {
            $place_id = $fetch['place_id'];
            $place_name = $fetch['place_name'];
            $login_id = $fetch['login_id'];
            $f_name = $fetch['f_name'];
            $l_name = $fetch['l_name'];
            $username = $fetch['username'];
            $mobile_no = $fetch['mobile_no'];
            // $user_status = $fetch['user_status'];

            $campquery = $conn->prepare("SELECT * FROM tbl_admin");
            $campquery->execute();
            $fetchcamp = $campquery->fetch();

            $admin_id = $fetchcamp['admin_id'];
            $admin_name = $fetchcamp['admin_name'];
        }
    }
} else {
    header("location: " . $_SERVER['SERVER_NAME']);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>EntryWay Control System</title>
    <!-- Favicon-->
    <link rel="icon" href="./images/entry_logo_only.png" type="image/x-icon">
    <link rel="icon" href="../images/entry_logo_only.png" type="image/x-icon">
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
        border-radius: 30px 0 0 30px;
        padding-left: 25px;
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
            width: 320px;
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
            width: 320px;
        }

        .searchbar {
            width: 256px;
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
</head>

<?php ob_end_flush(); ?>