<?php
include('../includes/db_controller.php');
date_default_timezone_set('Africa/Cairo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $scan_result = $_POST['scan_result'];
    $place_id = $_POST['place_id'];
    $stuffs = $_POST['stuffs'];
    $entrance_time = date("H:i:s");
    $exit_time = date("H:i:s");
    $entrance_date = date("Y-m-d");

    $sql = " SELECT * FROM tbl_user WHERE user_id='$scan_result' ";
    $query = $conn->prepare($sql);
    $query->execute();
    $count = $query->rowCount();

    $result = array();

    if ($count > 0) {

        $sql_1 = " SELECT * FROM tbl_records WHERE user_id='$scan_result' AND rec_date='$entrance_date' AND exit_time IS NULL ";
        $query_1 = $conn->prepare($sql_1);
        $query_1->execute();
        $count_1 = $query_1->rowCount();

        if ($count_1 > 0) {
            while ($row2 = $query_1->fetch()) {
                $rec_id = $row2['rec_id'];
            }

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = " UPDATE tbl_records SET exit_time='$exit_time', place_out='$place_id' WHERE rec_id='$rec_id' ";
            $conn->exec($sql);

            if ($sql) {
                $result['success'] = "1";
                $result['message'] = "success";

                echo json_encode($result);

                echo '<script language="javascript">
                        alert(" Record Updated Successfully ");
                        window.location.href = "record";
                    </script>';
            } else {
                $result['success'] = "0";
                $result['message'] = "error";

                echo json_encode($result);

                echo '<script language="javascript">
                        alert(" Record Updating Error ");
                        window.location.href = "record";
                    </script>';
            }
        } else {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql_data = " INSERT INTO tbl_records(user_id, place_id, entrance_time, stuffs, rec_date) 
            VALUES ('$scan_result','$place_id','$entrance_time', '$stuffs', '$entrance_date') ";
            $conn->exec($sql_data);

            if ($sql_data) {
                $result['success'] = "2";
                $result['message'] = "success";

                echo json_encode($result);

                echo '<script language="javascript">
                     alert(" Recorded successfully ");
                     window.location.href = "record";
                     </script>';
            } else {
                $result['success'] = "0";
                $result['message'] = "error";

                echo json_encode($result);

                echo '<script language="javascript">
                     alert(" Error Recording Data ");
                     window.location.href = "record";
                     </script>';
            }
        }
    } else {
        $result['success'] = "3";
        $result['message'] = "No User Found ";

        echo json_encode($result);

        echo '<script language="javascript">
                 alert(" User Doesnt Exist ");
                 window.location.href = "record";
                 </script>';
    }
}