<?php 
include ('../includes/header.php');
include('../includes/links.php');
?>


<?php include('../includes/top_bar.php');?>
    <section>
        <!-- Left Sidebar -->
         <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <?php include('profile.php');?>
            <!-- #User Info -->
            
            <!-- Menu -->
            <?php include('sidebar.php');?>
            <!-- #Menu -->
            
            <!-- Footer -->
            <?php include('../includes/footer.php');?>
            <!-- #Footer -->
        </aside>
    </section>

<?php 

	if(ISSET($_POST['btn_save_sub_cheq_point'])){
	    $sql_check = $db->prepare("SELECT * FROM tbl_place WHERE mobile_no=?");
		try{
		    $parent_id = $_POST['parent_id'];
			$place_name = $_POST['place_name'];
			$mobile_no = $_POST['mob_no'];
			
			$sql = " SELECT * FROM `tbl_place` WHERE place_id='$parent_id' ";
            $query = $conn->prepare($sql);
            $query->execute();
            while($fetch = $query->fetch()){
                $parent_name = $fetch['place_name'];
                $categ = $fetch['category'];
                $provincecode = $fetch['province_id'];
    			$districtcode = $fetch['district_id'];
    			$sector = $fetch['sector'];
    			$cell = $fetch['cell'];
    			$village = $fetch['village'];
            }
                
			
		
		   $sql_check->execute(array($mobile_no));
            $row_count_check = $sql_check->rowCount();
            if ($row_count_check >= 1)
            {
                $snap_msg="Mobile number have been taken!";
                       
            }else{
		
                //Register sub Checkpoint place
    			$date = date("Y-m-d");
    		    $time = date("H:i:s");
    			$role_id = '3';
    			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    			$sql = "INSERT INTO `tbl_place` (`place_name`, `location_name`,`mobile_no`, `category`,`province_id`,`district_id`, `sector`, `cell`, `village`, `parent`, `child`) 
    			VALUES ('$place_name', '$place_name', '$mobile_no','$categ','$provincecode','$districtcode','$sector','$cell', '$village', '0', '1')";
    			$conn->exec($sql);
    			$lastId = $conn->lastInsertId();
    
    		    $msg="Registered Successfully!";
    			
    			$new_password = rand(10000,99999);
                $new_password_encrypted = md5($new_password);
                $status="1";
        		
        		$pdo_crud = "INSERT INTO `tbl_users_login` (`f_name`, `l_name`,`username` ,`password`, `role_id`, `profile_id`, `telephone`, `date`, `status_login`, `staff_id`) 
        		VALUES ('$place_name', '$place_name', '$mobile_no', '$new_password_encrypted','$role_id','$lastId','$mobile_no','$date','$status','2')";
        		$conn->exec($pdo_crud);
        		
        		$pdo_crud = " INSERT INTO `tbl_sub_check_point`(`sub_place_id`, `place_id`) VALUES ('$lastId','$parent_id') ";
        		$conn->exec($pdo_crud);
        		
        		// message send data
                        
                        $msg=" $place_name mwandikishijwe na $parent_name ,
                        Username : $mobile_no ,
                        Password : $new_password ,
                        mwakoresha mwinjira kuri https://tracking.itecrwanda.com";
                        $data=array(
                                    "sender"=>'C TRACING',
                                    "recipients"=>"$mobile_no",
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
        		
        		echo '<script language="javascript">
                    alert(" My Place '.$place_name.'  Successfully Registered ");
                    window.location.href = "add_sub_check_point.php";
                </script>';
            }
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		
		$conn = null;
		header('location: add_sub_check_point.php');
	 }

 ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    MY SUB CHEQ POINT
                </h2>
            </div>
           
           <!-- Alert message -->
            <?php if($msg){?>
            <div class="alert bg-green alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Well done!</strong><?php echo htmlentities($msg); ?>
            </div>
            <?php } 
             else if($msge){?>
             
             <div class="alert bg-red alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Oh snap!</strong> <?php echo htmlentities($msge); ?>
                </div>
             <?php } ?>
             
             <?php
             if($mssg){?>
              <div class="alert bg-red alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Oh snap!</strong> <?php echo htmlentities($mssg); ?>
                </div>
             <?php } ?>
             
             
            <?php if($save_message){?>
            <div class="alert bg-green alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Well done!</strong><?php echo htmlentities($save_message); ?>
            </div>
            <?php } ?>
           
           
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <!--<a href="">-->
                            <!--    <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Add Admin</button>-->
                            <!--</a>-->
                            <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">NEW SUB CHEQ POINT</button>
                         </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                                    <!--<table class="table table-bordered table-striped table-hover dataTable js-exportable">-->
                                    <thead class="">
                                        <tr>
                                            <th>No</th>
                                            <th>Names</th>
                                            <th>Phone No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        
                                            $no =0;
                                            $neg =2;
                    						$sql = " SELECT * FROM tbl_sub_check_point,tbl_place WHERE tbl_sub_check_point.sub_place_id=tbl_place.place_id AND tbl_sub_check_point.place_id='$prof_id' ";
                    						$query = $conn->prepare($sql);
                    						$query->execute();
                    							
                    							while($fetch = $query->fetch()){
                    							    $user_id=$fetch['user_id'];
                    							    $no +=1;
                        						
                    					?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $fetch['place_name']?></td>
                                            <td><?php echo $fetch['mobile_no']?></td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                					
                					<?php
                						}
                					?>
                             
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
       </div>
    </section>
    
    <!-- Modal Data -->

                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                         <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Cheq Point Info.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                             <form id="form_validation" method="POST" action="" >
                                 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="hidden" class="form-control" name="parent_id" value="<?php echo $prof_id; ?>" required>
                                        <input type="text" class="form-control" name="place_name" required>
                                        <label class="form-label">Cheq Point Name</label>
                                    </div>
                                </div>
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="mob_no" required>
                                        <label class="form-label">Mobile No.</label>
                                    </div>
                                </div>
                               
                           </div>
                          <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_save_sub_cheq_point" class="btn btn-primary">Save Sub Cheq Point</button>
                      </div>
                     </form>
                 </div>
              </div>
            </div>
    
    <?php include('../includes/js.php');?>  
    </body>
</html>