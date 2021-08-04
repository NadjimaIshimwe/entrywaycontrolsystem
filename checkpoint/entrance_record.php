<?php
include('../includes/db_controller.php');
date_default_timezone_set('Africa/Kigali');

$scan_result = $_POST['scan_result'];
$stuffs = $_POST['stuffs'];
$userId = $_POST['userId'];
$place_id = $_POST['place_id'];
$time = date("H:i:s");
$entrance_date = date("Y-m-d");
$midnight_time = (new DateTime())->setTime(0, 0)->format('H:i:s');

$sql = " SELECT * FROM tbl_records WHERE user_id='$scan_result' ";
$query = $conn->prepare($sql);
$query->execute();
$count = $query->rowCount();
if (isset($_POST['make_record'])) {
    if ($count >= 1) {
        $fetch = $query->fetch();
        if (empty($fetch['exit_time'])) {
            $sql = $conn->prepare(" UPDATE tbl_records SET exit_time='$midnight_time' WHERE rec_id='$scan_result' ");
            $sql->execute();
        }
        $sql2 = $conn->prepare(" INSERT into tbl_records(`user_id`, `place_id`, `entrance_time`, `stuffs`, `rec_date`) values ('" . $fetch['user_id'] . "', '$place_id', '" . $fetch['entrance_time'] . "', '$stuffs', '$entrance_date') ");
        $sql2->execute();
        if ($sql2) {
            $result['success'] = "1";
            $result['message'] = "success";

            echo json_encode($result);

            echo '<script language="javascript">
                    alert(" Recorded Successfully ");
                window.location.href = "record.php";
                </script>';
        } else {
            $result['success'] = "0";
            $result['message'] = "error";

            echo json_encode($result);

            echo '<script language="javascript">
                    alert(" Record Updating Error ");
                    window.location.href = "record.php";
                </script>';
        }
    } else {
        $sql2 = $conn->prepare(" INSERT into tbl_records(`user_id`, `place_id`, `entrance_time`, `stuffs`, `rec_date`) values ('" . $userId . "', '$place_id', '" . $time . "', '$stuffs', '$entrance_date') ");
        $sql2->execute();
        echo '<script language="javascript">
                    alert(" Recorded Successfully ");
                window.location.href = "record.php";
                </script>';
    }
} else if (isset($_POST['confirm_leave'])) {
    $sql = $conn->prepare(" UPDATE tbl_records SET exit_time='$time', place_out='$place_id' WHERE rec_id='$scan_result' ");
    $sql->execute();
    echo '<script language="javascript">
                    alert(" Leaving Confirmed ");
                window.location.href = "record.php";
                </script>';
} else {
    $result['success'] = "2";
    $result['message'] = "No User Found ";

    echo json_encode($result);

    echo '<script language="javascript">
                alert(" User Doesn\'t Exist ");
                window.location.href = "record.php";
                </script>';
}