<?php
include '../includes/db_controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $UserTel = $_POST['UserTel'];
    $result = array();
    $result['login'] = array();
    $entrance_date = date("Y-m-d");

    $st_query = $conn->prepare(" SELECT * FROM `tbl_user` where mobile_no='$UserTel' ");
    $st_query->execute();
    if ($st_query->rowCount() > 0) {
        $st_task_data = $st_query->fetch();
        $f_name = $st_task_data['f_name'];
        $l_name = $st_task_data['l_name'];
        $mobile = $st_task_data['mobile_no'];
        $id_no = $st_task_data['id_no'];
        $user_id = $st_task_data['user_id'];
        $user_type = $st_task_data['user_type'];
        $st_type = $conn->prepare(" SELECT * FROM `tbl_user_type` where id='$user_type' ");
        $st_type->execute();
        $st_type_data = $st_type->fetch();

        $sql_1 = " SELECT * FROM tbl_records,tbl_place WHERE tbl_records.place_id= tbl_place.place_id and user_id='$user_id' ORDER BY rec_id DESC LIMIT 1 ";
        $query_1 = $conn->prepare($sql_1);
        $query_1->execute();
        $count_1 = $query_1->rowCount();
        $row2 = $query_1->fetch();
        if ($count_1 < 1 || (!empty($row2['exit_time']))) {
            $index['entry_status'] = "Not Yet In";
            $result['success'] = "1";
        } else {
            $index['entry_status'] = "Already In";
            $result['success'] = "2";
        }

        $index['f_name'] = $f_name;
        $index['l_name'] = $l_name;
        $index['mobile'] = $mobile;
        $index['NID'] = $id_no;
        $index['user_id'] = $user_id;
        $index['user_type'] = $st_type_data['name'];
        $index['stuffs'] = $row2['stuffs'];
        $index['place_name'] = $row2['place_name'];

        array_push($result['login'], $index);

        $result['message'] = "success";
        echo json_encode($result);

        echo '<script language="javascript">
                alert(" User Available ' . $names . '  ");
                window.location.href = "index.php";
            </script>';
    } else {
        $result['success'] = "3";
        $result['message'] = "No User Found ";

        echo json_encode($result);

        echo '<script language="javascript">
                alert(" User Doesn\'t Exist ");
                window.location.href = "index.php";
            </script>';
    }
}