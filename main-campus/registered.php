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
            
            <!-- #Start# Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <?php 
                                    $today=date("Y-m-d");
                                ?>
                                Students Registred Today 
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?php
                                    
                                $sql = " SELECT * FROM `tbl_user` WHERE user_reg_date BETWEEN '$today 00:00:00' AND '$today 23:59:00' ORDER BY user_id DESC ";
                                $query = $conn->prepare($sql);
                                $query->execute();
                                $data = $query->rowCount();
                                    
                                    if($data >=1){
                                        
                                        ?>
                                        
                                            <div class="row clearfix">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Reg No</th>
                                                                            <th>Names</th>
                                                                            <th>ID No</th>
                                                                            <th>Phone</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Reg No</th>
                                                                            <th>Names</th>
                                                                            <th>ID No</th>
                                                                            <th>Phone</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                    <tbody>
                                                                        <?php
                                                                            $no =0;
                                                    						$sql = " SELECT * FROM `tbl_user` WHERE user_reg_date BETWEEN '$today 00:00:00' AND '$today 23:59:00' ORDER BY user_id DESC ";
                                                    						$query = $conn->prepare($sql);
                                                    						$query->execute();
                                                    							
                                                    							while($fetch = $query->fetch()){
                                                    							    $client_id=$fetch['user_id'];
                                                    							    $no +=1;
                                                    							
                                                    							if($fetch['exit_time'] == NULL){
                                                    							    $exit_time = "<b style='color:red'>Didn't Exit</b>";
                                                    							}else{
                                                    							    $exit_time = $fetch['exit_time'] ;
                                                    							}
                                                    					?>
                                                                        <tr>
                                                                            <td><?php echo $no;?></td>
                                                                            <td><?php echo $fetch['reg_no']?></td>
                                                                            <td><?php echo $fetch['f_name']?> <?php echo $fetch['l_name']?></td>
                                                                            <td><?php echo $fetch['id_no']?></td>
                                                                            <td><?php echo $fetch['mobile_no']?></td>
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
                                        <?php
                                        
                                    }else{
                                        ?>
                                            <center>
                                                <br>
                                                <div class="alert bg-red alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    No Data Available for <?php echo $reg_no; ?>
                                                </div>
                                            </center>
                                        <?php
                                        
                                    }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->
            
        </div>
    </section>
    
    <?php include('../includes/js.php');?>  
    </body>
</html>