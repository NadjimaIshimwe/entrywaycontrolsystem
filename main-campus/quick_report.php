<?php 
include ('../includes/header.php');
include('../includes/links.php');
?>

    <style>
        button{
            border: none;
            background-color: transparent;
        }
        .grid{
          height:23px;
          position:relative;
          bottom:4px;
        }
        .signbutton{
          background-color: #71110f;
          color: #fff;
          border:none;
          border-radius:3px;
          margin-top:10px;
          padding:7px 10px;
          position:relative;
          bottom:7px;
          font-weight:bold;
        }
        .logo{
          margin-top:60px;
          margin-bottom:20px;
        }
        .bar{
          margin:0 auto;
          width:575px;
          border-radius:30px;
          border:1px solid #dcdcdc;
        }
        .bar:hover{
          box-shadow: 1px 1px 8px 1px #dcdcdc;
        }
        .bar:focus-within{
          box-shadow: 1px 1px 8px 1px #dcdcdc;
          outline:none;
        }
        .searchbar{
          height:43px;
          border:none;
          width:500px;
          font-size:16px;
          outline: none;
          
        }
        .voice{
          height:20px;
          position:relative;
          top: -2px;
        }
        .buttons{
          margin-top:30px;
        }
        .button{
          background-color: #f5f5f5;
          border:none;
          color:#707070;
          font-size:15px;
          padding: 10px 20px;
          margin:5px;
          border-radius:4px;
          outline:none;
        }
        .button:hover{
          border: 1px solid #c8c8c8;
          padding: 9px 19px;
          color:#808080;
        }
        .button:focus{
          border:1px solid #4885ed;
          padding: 9px 19px;
        }
        
        @media screen and (max-width: 400px) {
            .bar{
                width: 320px;
                max-width: inherit;
            }
            .searchbar {
                width: 256px;
                margin-left: 18px;
            }
            .logo {
                margin-top: 100px;
                margin-bottom: 20px;
            }
        }
        
        @media screen and (max-width: 360px) {
            .bar{
                width: 300px;
                max-width: inherit;
            }
            .searchbar {
                width: 260px;
            }
            .logo {
                margin-top: 148px;
                margin-bottom: 20px;
            }
            .chur_data{
            margin-left:5px !important;
            }
            .advert{
                margin-left:5px !important;
                display:none;
            }
            .chms {
                margin-left: 52px !important;
                float: none !important;
                height: 83px;
            }
        }
        
        @media screen and (max-width: 400px) {
            .bar{
                width: 320px;
                max-width: inherit;
            }
            .searchbar {
                width: 260px;
            }
            .logo {
                margin-top: 148px;
                margin-bottom: 20px;
            }
            .chur_data{
            margin-left:5px !important;
            }
            .advert{
                margin-left:5px !important;
                display:none;
            }
            .chms {
                margin-left: 60px;
                float: none !important;
                height: 83px;
            }
        }
        
        @media screen and (max-width: 415px) {
            .bar{
                width: 360px;
                max-width: inherit;
            }
            .searchbar input {
                width: 277px;
                margin-left: 18px;
            }
            .logo {
                margin-top: 100px;
                margin-bottom: 20px;
            }
            .chur_data{
            margin-left:5px !important;
            }
            .advert{
                margin-left:5px !important;
                display:none;
            }
            .chms {
                margin-left: 78px;
                float: none !important;
                height: 69px !important;
            }
        }
        
        @media screen and (max-width: 565px) {
            .bar{
                width: 280px;
                max-width: inherit;
            }
            .searchbar {
                width: 209px;
                margin-left: 18px;
            }
            .logo {
                margin-top: 100px;
                margin-bottom: 20px;
            }
            .chur_data{
            margin-left:5px !important;
            }
            .advert{
                margin-left:5px !important;
                display:none;
            }
        }
    </style>

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
                                Quick Report
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
                            <center>
                                    
                                <div class="bar">
                                    <div class="autocomplete">
                                        <form  method="POST" action="">
                                            <input class="searchbar" type="text" title="Search" id="search" name="reg_no" placeholder=" Search By Student Registration Number" required>
                                            <button type="submit" >
                                               <img class="voice" src="../images/search.png" title="Search by Name">
                                            </button>
                                        </form>
                              
                                    </div>
                                </div>
                                
                            </center>
                            <?php
                                $reg_no = $_POST['reg_no'];
                                
                                if(!empty($reg_no)){
                                    
                                    $sql = " SELECT * FROM tbl_user,tbl_place,tbl_records WHERE tbl_records.user_id=tbl_user.user_id AND tbl_records.place_id=tbl_place.place_id AND tbl_user.reg_no='$reg_no' ORDER BY tbl_records.rec_id DESC ";
                                    $query = $conn->prepare($sql);
                                    $query->execute();
                                    $data = $query->rowCount();
                                        
                                        if($data >=1){
                                            
                                            ?>
                                                <hr>
                                                <div class="row clearfix">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <h4>
                                                            <center>
                                                                Results Found
                                                            </center>
                                                        </h4>
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
                                                                                <th>Entrance Time</th>
                                                                                <th>Exit Time</th>
                                                                                <th>Entrance date</th>
                                                                                <th>Check Point</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>Reg No</th>
                                                                                <th>Names</th>
                                                                                <th>ID No</th>
                                                                                <th>Phone</th>
                                                                                <th>Entrance Time</th>
                                                                                <th>Exit Time</th>
                                                                                <th>Entrance date</th>
                                                                                <th>Check Point</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                        <tbody>
                                                                            <?php
                                                                                $no =0;
                                                        						$sql = " SELECT tbl_user.user_id,tbl_user.f_name,tbl_user.l_name,tbl_user.mobile_no,tbl_user.id_no,tbl_user.reg_no,tbl_place.place_id,tbl_place.place_name,tbl_records.entrance_time,tbl_records.exit_time,tbl_records.rec_date FROM tbl_user,tbl_place,tbl_records WHERE tbl_records.user_id=tbl_user.user_id AND tbl_records.place_id=tbl_place.place_id AND tbl_user.reg_no='$reg_no' ORDER BY tbl_records.rec_id DESC ";
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
                                                                                <td><?php echo $fetch['entrance_time']?></td>
                                                                                <td><?php echo $exit_time;?></td>
                                                                                <td><?php echo $fetch['rec_date']?></td>
                                                                                <td><?php echo $fetch['place_name']?></td>
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
                                    
                                }
                                else{
                                    ?>
                                    
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