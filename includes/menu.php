    <?php
        if($role_id == 1){
            // admin menu
            ?>
            
            <!-- Place Menu-->
            <div class="menu">
                <ul class="list">
                    <li class="header">ADMIN MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="material-icons">domain</i>
                            <span>Home</span>
                        </a>
                    </li>
                    
                     
                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Records Report</span>
                          </a>
                        
                        <ul class="ml-menu">
                            <li>
                                <a href="rpt_admin_all_record.php">View All History</a>
                            </li>
                            <li>
                                <a href="rpt_admin_all_no_exit_record.php">No Exit History</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">dns</i>
                            <span>Category</span>
                          </a>
                        
                        <ul class="ml-menu">
                            <li>
                                <a href="admin_new_category.php">New Category</a>
                            </li>
                            <li>
                                <a href="admin_view_category.php">View All Category</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">add_business</i>
                            <span>Place</span>
                          </a>
                        
                        <ul class="ml-menu">
                            <li>
                                <a href="#">New Place</a>
                            </li>
                            <li>
                                <a href="admin_view_places.php">View All Place</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">add_alert</i>
                            <span>Notification</span>
                          </a>
                        
                        <ul class="ml-menu">
                            <li>
                                <a href="admin_notify_person.php">Person</a>
                            </li>
                            <li>
                                <a href="admin_notify_places.php">Place / Bike</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!--<li>-->
                    <!--     <a href="javascript:void(0);" class="menu-toggle">-->
                    <!--        <i class="material-icons">sms</i>-->
                    <!--        <span>Group Notification</span>-->
                    <!--      </a>-->
                        
                    <!--    <ul class="ml-menu">-->
                    <!--        <li>-->
                    <!--            <a href="admin_notify_person.php">Person</a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                    
                    <!--<li>-->
                    <!--     <a href="javascript:void(0);" class="menu-toggle">-->
                    <!--        <i class="material-icons">people_alt</i>-->
                    <!--        <span>Person Details</span>-->
                    <!--      </a>-->
                        
                    <!--    <ul class="ml-menu">-->
                    <!--        <li>-->
                    <!--            <a href="rpt_place_people_history.php">Person</a>-->
                    <!--        </li>-->
                    <!--        <li>-->
                    <!--            <a href="rpt_place_no_exit_history.php">Place / Bike</a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                              
                </ul>
            </div>
            <!-- end of Place Menu -->
            
            
            <?php
        }else if($role_id == 2){
            // place or bike menu
            ?>
            
            <?php
                $sql = " SELECT * FROM tbl_place WHERE place_id='$prof_id' "; 
                $query = $conn->prepare($sql);
                $query->execute();
                        							
                    while($fetch = $query->fetch()){
                     $place_id = $fetch['place_id'];
                     $place_name = $fetch['place_name'];
                     $loc_name = $fetch['location_name'];
                     $cat = $fetch['category'];
                        
                    }
              ?>
            
            <!-- Place Menu-->
            <div class="menu">
                <ul class="list">
                    <li class="header"><?php echo $place_name; ?> MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="material-icons">
                                <?php
                                    if($cat == 1){
                                        $category_data = "store";
                                    }else if($cat == 2){
                                        $category_data = "directions_bike";
                                    }else if($cat == 3){
                                        $category_data = "directions_car";
                                    }else if($cat == 4){
                                        $category_data = "directions_bus";
                                    }else if($cat == 5){
                                        $category_data = "account_balance";
                                    }else if($cat == 6){
                                        $category_data = "foundation";
                                    }else if($cat == 7){
                                        $category_data = "directions_walk";
                                    }else if($cat == 8){
                                        $category_data = "business";
                                    }else if($cat == 9){
                                        $category_data = "domain";
                                    }
                                    else{
                                        $category_data = "Uncategorized";
                                    }
                                ?>
                                <?php echo $category_data; ?>
                            </i>
                            <span>Home</span>
                        </a>
                    </li>
                    
                    <?php
                        if($cat == 1){
                            $category_data = "store";
                            ?>
                            
                                <li>
                                     <a href="javascript:void(0);" class="menu-toggle">
                                        <i class="material-icons">store</i>
                                        <span>Place</span>
                                      </a>
                                    
                                    <ul class="ml-menu">
                                        <li>
                                            <a href="rpt_place_no_exit_history.php">View All Place</a>
                                        </li>
                                    </ul>
                                </li> 
                                
                            <?php
                        }else if($cat == 2){
                            $category_data = "directions_bike";
                            ?>
                            
                            <?
                        }else if($cat == 3){
                            $category_data = "directions_car";
                            ?>
                            
                            <?
                        }else if($cat == 4){
                            $category_data = "directions_bus";
                            ?>
                            
                            <?
                        }else if($cat == 5){
                            $category_data = "account_balance";
                            ?>
                                
                                <li>
                                     <a href="javascript:void(0);" class="menu-toggle">
                                        <i class="material-icons">store</i>
                                        <span>Place</span>
                                      </a>
                                    
                                    <ul class="ml-menu">
                                        <li>
                                            <a href="rpt_place_no_exit_history.php">View All Place</a>
                                        </li>
                                    </ul>
                                </li>
                                
                            <?
                        }else if($cat == 6){
                            $category_data = "foundation";
                            ?>
                            
                            <?
                        }else if($cat == 7){
                            $category_data = "directions_walk";
                            ?>
                            <?
                        }else if($cat == 8){
                            $category_data = "business";
                            ?>
                                
                                <li>
                                     <a href="javascript:void(0);" class="menu-toggle">
                                        <i class="material-icons">store</i>
                                        <span>Place</span>
                                      </a>
                                    
                                    <ul class="ml-menu">
                                        <li>
                                            <a href="rpt_place_no_exit_history.php">View All Place</a>
                                        </li>
                                    </ul>
                                </li>
                                
                            <?
                        }else if($cat == 9){
                            $category_data = "domain";
                            ?>
                                
                                <li>
                                     <a href="javascript:void(0);" class="menu-toggle">
                                        <i class="material-icons">store</i>
                                        <span>Place</span>
                                      </a>
                                    
                                    <ul class="ml-menu">
                                        <li>
                                            <a href="rpt_place_no_exit_history.php">View All Place</a>
                                        </li>
                                    </ul>
                                </li>
                                
                            <?
                        }
                        else{
                            $category_data = "Uncategorized";
                        }
                    ?>
                    
                    <li>
                         <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Report</span>
                          </a>
                        
                        <ul class="ml-menu">
                            <!--<li>-->
                            <!--    <a href="rpt_place_people_history.php">View All History</a>-->
                            <!--</li>-->
                            <li>
                                <a href="report_filter.php">View Report</a>
                            </li>
                            <li>
                                <a href="rpt_place_no_exit_history.php">No Exit History</a>
                            </li>
                        </ul>
                    </li>
                              
                </ul>
            </div>
            <!-- end of Place Menu -->
            
            <?php
        }else if($role_id == 3){
            // user Client menu
            ?>
            
            <!-- user client Menu-->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    
                     
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Report</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="rpt_my_places.php">View places</a>
                            </li>                           
                        </ul>
                    </li>
                              
                </ul>
            </div>
            <!-- end of user Client Menu -->
            
            <?php
        }else if($role_id == 116){
            // user Client menu
            ?>
            
            <!-- user client Menu-->
            <div class="menu">
                <ul class="list">
                    <li class="header">RIB NAVIGATION</li>
                    
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="material-icons">important_devices</i>
                            <span>Home</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_pin</i>
                            <span>People Records</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="rib_view_records.php">All Records</a>
                            </li>                            
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">commute</i>
                            <span>Cars Records</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="#">All Records</a>
                            </li>                           
                        </ul>
                    </li>
                     
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">people_alt</i>
                            <span>Agents</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="rib_new_agent.php">New Agent</a>
                            </li> 
                            <li>
                                <a href="rib_view_agents.php">View Agents</a>
                            </li>                           
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_add_disabled</i>
                            <span>Stop List</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="rib_add_stop_list.php">Add Stop List</a>
                            </li> 
                            <li>
                                <a href="rib_view_stop_list.php">View Stop List</a>
                            </li>                           
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Stop Tasks</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="rib_stop_list_pending.php">Pending Stop List</a>
                            </li> 
                            <li>
                                <a href="rib_stop_list_complete.php">Completed Stop List</a>
                            </li>                           
                        </ul>
                    </li>
                              
                </ul>
            </div>
            <!-- end of user Client Menu -->
            
            <?php
        
        }else if($role_id == 4){
            // user Client menu
            ?>
            
            <!-- user client Menu-->
            <div class="menu">
                <ul class="list">
                    <li class="header">AGENT NAVIGATION</li>
                    
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_pin</i>
                            <span>People Records</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="rib_view_records.php">All Records</a>
                            </li>                            
                        </ul>
                    </li>
                     
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">notification_important</i>
                            <span>Wanted</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="agent_view_wanted_list.php">Wanted List</a>
                            </li>
                            <li>
                                <a href="agent_view_complete_task.php">Complete List</a>
                            </li>
                        </ul>
                    </li>
                              
                </ul>
            </div>
            <!-- end of user Client Menu -->
            
            <?php
        }else{
            ?>
            <?php
        }     
    ?>
            
            