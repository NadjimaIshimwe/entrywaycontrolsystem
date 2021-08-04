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
    
    <section class="content">
        <div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Student Access Report
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Reg No</th>
                                            <th>Names</th>
                                            <th>Phone</th>
                                            <th style="padding: 0 55px;">Faculty</th>
                                            <th>Department</th>
                                            <th>Session</th>
                                            <th>Gate</th>
                                            <th style="padding: 0 45px;">Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no =0;
                    						$sql = " SELECT * FROM tbl_records, tbl_place WHERE tbl_records.place_id = tbl_place.place_id AND tbl_place.camp_place_id = $camp_place_id ";
                    						$query = $conn->prepare($sql);
                    						$query->execute();
                    						
                							while($fetch = $query->fetch()){
                                            $no += 1;
                    						$user_id = $fetch['user_id']; 
                    						
                                            $stsql = " SELECT * FROM students where id=$user_id";
                    						$stquery = $DB_CRUD2->prepare($stsql);
                    						$stquery->execute();
                    						$stfetch = $stquery->fetch();
                    						
                    				// 		faculty
                    				        $fac = $stfetch['faculity_id'];
                    				        $facsql = " SELECT * FROM faculities where id=$fac";
                    						$facquery = $DB_CRUD2->prepare($facsql);
                    						$facquery->execute();
                    						$facfetch = $facquery->fetch();
                    				
                    				//      department
                    				        $dept = $stfetch['department_id'];
                    				        $deptsql = " SELECT * FROM departments where id=$dept";
                    						$deptquery = $DB_CRUD2->prepare($deptsql);
                    						$deptquery->execute();
                    						$deptfetch = $deptquery->fetch();

                    					?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $stfetch['registration_number']?></td>
                                            <td><?php echo $stfetch['names']?></td>
                                            <td><?php echo $stfetch['telephone']?></td>
                                            <td><?php echo $facfetch['description']?></td>
                                            <td><?php echo $deptfetch['name']?></td>
                                            <td><?php echo $stfetch['session']?></td>
                                            <td><?php echo $fetch['place_name']?></td>
                                            <td><?php echo $fetch['rec_date'].' '.$fetch['entrance_time'];?></td>
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
    
  <?php include('../includes/js.php');?>  
 </body>
</html>