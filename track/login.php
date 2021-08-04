<?php
include './connect.php';

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['username'] != "" || $_POST['password'] != "") {

        $username = $_POST['username'];

        $password = $_POST['password'];

        $password = md5($_POST["password"]);

        $status = '1';

        $tm = date("Y-m-d H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql = "SELECT * FROM `tbl_users_login` WHERE `username`=? AND `password`=? AND status_login=? ";
        $query = $conn->prepare($sql);
        $query->execute(array($username, $password, $status));
        $row = $query->rowCount();
        $fetch = $query->fetch();


        $result = array();
        $result['login'] = array();

        if ($row > 0) {

            $role = $fetch['role_id'];
            $place_id = $fetch['user_id'];

            //Variable session
            $_SESSION['login_id'] = $fetch['login_id'];
            $_SESSION['role'] = $fetch['role_id'];
            $_SESSION['sess_id'] = $sess_id;
            $_SESSION['username'] = $username;
            $_SESSION['status'] = 'ON';


            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `tbl_user_session` VALUES ('', '$sess_id', '$username', '$ip', '$tm','','$_SESSION[status]')";
            $conn->exec($sql);

            if (($role == 2) || ($role == 1)) {

                // select from placce or bike table

                $sql_1 = " SELECT * FROM tbl_place WHERE place_id=$place_id ";
                $query_1 = $conn->prepare($sql_1);
                $query_1->execute();
                while ($fetch_1 = $query_1->fetch()) {
                    $place_tel = $fetch_1['mobile_no'];
                    $place_name = $fetch_1['place_name'];
                    $location_name = null;
                    $place_id = $fetch_1['place_id'];
                }
                // end of bike or place table

                $index['name'] = $place_name;
                $index['username'] = $location_name;
                $index['user_id'] = $place_id;

                array_push($result['login'], $index);

                $result['success'] = "1";
                $result['message'] = "success";
                echo json_encode($result);

                echo "
    				<script>alert('Security Login Succeded!')</script>
    				<script>window.location = 'index.php'</script>
    				";
            } else if (($role == 4)) {

                // select from user table

                $sql_2 = " SELECT * FROM tbl_user WHERE user_id=$prof_id ";
                $query_2 = $conn->prepare($sql_2);
                $query_2->execute();
                while ($fetch_2 = $query_2->fetch()) {
                    $user_tel = $fetch_2['mobile_no'];
                    $f_name = $fetch_2['f_name'];
                    $l_name = $fetch_2['l_name'];
                    $user_id = $fetch_2['user_id'];
                    //$user_id = openssl_encrypt($user_id, "AES-128-ECB", DONE);
                }
                // end of user table


                $index['name'] = $f_name;
                $index['username'] = $l_name;
                $index['user_id'] = $user_id;

                array_push($result['login'], $index);

                $result['success'] = "2";
                $result['message'] = "success";
                echo json_encode($result);

                echo "
    				<script>alert('User Login Succeded!')</script>
    				<script>window.location = 'index.php'</script>
    				";
            } else if (($role == 2) and ($staff == 3)) {

                // select from Staff table AS Surveillance

                $sql_2 = " SELECT * FROM `tbl_staff` WHERE staff_id='$prof_id' AND staff_role='3' ";
                $query_2 = $conn->prepare($sql_2);
                $query_2->execute();
                while ($fetch_2 = $query_2->fetch()) {
                    $user_tel = $fetch_2['staff_tel'];
                    $f_name = $fetch_2['first_name'];
                    $l_name = $fetch_2['last_name'];
                    $user_id = $fetch_2['staff_id'];
                }
                // end of user table


                $index['name'] = $f_name;
                $index['username'] = $l_name;
                $index['user_id'] = $user_id;

                array_push($result['login'], $index);

                $result['success'] = "3";
                $result['message'] = "success";
                echo json_encode($result);

                echo "
    				<script>alert(' Survaillance Login Succeded!')</script>
    				<script>window.location = 'index.php'</script>
    				";
            } else {

                $result['success'] = "0";
                $result['message'] = "error";
                echo json_encode($result);

                echo "
    				<script>alert('You are not allowed to use the app')</script>
    				<script>window.location = 'index.php'</script>
    				";
            }
        } else {

            $result['success'] = "0";
            $result['message'] = "error";
            echo json_encode($result);

            echo "
				<script>alert('Your username or password is incorrect!')</script>
				<script>window.location = 'index.php'</script>
				";
        }
    } else {
        echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
    }
}