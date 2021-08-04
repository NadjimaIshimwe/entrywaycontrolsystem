<?php
require_once'config.php';

// ecnryption data
	function simple_crypt( $string, $action = 'e' ) {
        // you may change these values to your own
        $secret_key = 'Information Technology & Engineering Construction Ltd (ITEC Ltd) website) ';
        $secret_iv = 'ChMS (Church MANAGEMENT SYSTEM)';
     
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
     
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
     
        return $output;
    }
// end of encrytpion data
    
if ($_SERVER['REQUEST_METHOD'] =='POST') {
    
    $scan_result = $_POST['scan_result'];

    $query=$conn->query(" SELECT * FROM tbl_user WHERE user_id='$scan_result' ");
    $result = array();
    $result['login'] = array();
    if($query->num_rows >= 1){

    	$sql_task_data=" SELECT * FROM tbl_user WHERE user_id='$scan_result' ";
        $result_task_data=$conn->query($sql_task_data);
            while ($row_task_data = $result_task_data->fetch_assoc()) {
            $f_name = $row_task_data['f_name'];
            $l_name = $row_task_data['l_name'];
            $user_id = $row_task_data['user_id'];
            $user_pic = $row_task_data['user_pc'];
            $user_status = $row_task_data['user_status'];
            
            //$actualpath = "https://tracking.itecrwanda.com/upload/$user_pic";

            //$user_id = openssl_encrypt($user_id, "AES-128-ECB", DONE);
            
            $index['name'] = $f_name;
            $index['lname'] = $l_name;
            $index['user_id'] = $user_id;
            $index['user_pic'] = $user_pic;
            $index['user_covid_stat'] = $user_status;
    
            array_push($result['login'], $index);
    
            $result['success'] = "1";
            $result['message'] = "success";
            echo json_encode($result);
            mysqli_close($conn);
    
            echo '<script language="javascript">
                alert(" User Available '.$f_name.' - '.$l_name.' - '.$user_id.'  ");
                window.location.href = "index.php";
            </script>';
        }
        
    }
    else
    {
        $result['success'] = "2";
        $result['message'] = "No User Found ";

        echo json_encode($result);
        mysqli_close($conn);

        echo '<script language="javascript">
            alert(" User Doesnt Exist ");
            window.location.href = "index.php";
        </script>';
    }
}

?>