<?php
require_once'config.php';
if ($_SERVER['REQUEST_METHOD'] =='POST') {
    
    $user_id = $_POST['user_data'];
    
    $entrance_date = date("Y-m-d");


    $query=$conn->query(" SELECT * FROM `tbl_records` WHERE user_id='$user_id' AND rec_date='$entrance_date' AND exit_time IS NULL ");
    if($query->num_rows >= 1){

        $query=$conn->query(" SELECT * FROM `tbl_records`,`tbl_user` WHERE tbl_records.user_id=tbl_user.user_id AND tbl_records.rec_date='$entrance_date' AND tbl_records.exit_time IS NULL AND tbl_user.user_status='1' ");
        if($query->num_rows >= 1){
            
            $result['success'] = "1";
            $result['message'] = "success";

            echo json_encode($result);
            mysqli_close($conn);

            echo '<script language="javascript">
                    alert(" Person Quarantined Found ");
                    window.location.href = "index.php";
                  </script>';
        } 
        else
        {
            $result['success'] = "0";
            $result['message'] = " No Person Quarantined Found ";
    
            echo json_encode($result);
            mysqli_close($conn);
    
            echo '<script language="javascript">
                     alert(" No Person Quarantined Found ");
                     window.location.href = "index.php";
                  </script>';
        }
    }
    else
    {
        $result['success'] = "0";
        $result['message'] = " No Person Quarantined Found ";

        echo json_encode($result);
        mysqli_close($conn);

        echo '<script language="javascript">
                 alert(" No Person Quarantined Found ");
                 window.location.href = "index.php";
              </script>';
    }
}

?>