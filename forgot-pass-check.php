<?php
	include 'includes/header.php';
	
	if(ISSET($_POST['reset_password'])){

		$user_tel = $_POST['user_tel'];
		
		$stms3333 = $db->prepare("SELECT telephone FROM tbl_users_login WHERE telephone=?  ");
		
            try {
                $stms3333->execute(array($user_tel));
                $row_count333 = $stms3333->rowCount();
                    if ($row_count333 > 0)
                    {
                        $new_password = rand(10000,99999);
                        $new_password_encrypted = md5($new_password);
                        
                        $stmt = $db->prepare("UPDATE tbl_users_login SET password=? WHERE telephone=?");
                        $stmt->execute(array($new_password_encrypted,$user_tel));
                        
                        echo '<script language="javascript">
                          alert("Password have been successfully resetted And Sent to '.$user_tel.' ");
                          window.location.href = "forgot-password";
                          </script>';
                        
                        // message send data
                        
                        $msg="Thank you for reset! New password is:  $new_password, More info,Tel :0783093662.";
                        
                        $data=array(
                                    "sender"=>'PIASS',
                                    "recipients"=>"$user_tel",
                                    "message"=>"$msg",
                            );
                    
                        $url="https://www.intouchsms.co.rw/api/sendsms/.json";
                        $data=http_build_query($data);
                        $username="twagiramungus";
                        $password="M00dle!!";
                    
                        $ch=curl_init();
                        curl_setopt($ch,CURLOPT_URL,$url);
                        curl_setopt($ch,CURLOPT_USERPWD,$username.":".$password);
                        curl_setopt($ch,CURLOPT_POST,true);
                        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
                        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
                        $result=curl_exec($ch);
                        $httpcode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
                        curl_close($ch);
                    
                        //echo $result;
                    
                        //echo $httpcode;
                        
                    }else{
                        echo '<script language="javascript">
                          alert(" Sorry  '.$user_tel.' Not Exist In PIASS GetAccess System");
                          window.location.href = "index";
                          </script>';
                    }
            }
            catch (PDOException $ex) {
                echo $ex->getMessage();
            }
		
		$conn = null;
		header('location: index.php');
	}
?>