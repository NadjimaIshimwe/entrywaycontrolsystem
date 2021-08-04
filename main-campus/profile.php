            <div class="user-info">
                <div>
                    <?php
                    $sql = $conn->prepare(" SELECT * FROM `tbl_admin` WHERE `admin_id` = '" . $_SESSION['user_id'] . "'  ");
                    $sql->execute();
                    while ($fetch = $sql->fetch()) {
                        $admin_name = $fetch['admin_name'];
                        $fileName = "../images/avatar5.png";
                    }
                    ?>
                    <img src="<?php echo $fileName; ?>" class="img-square" alt="User Image" width="100px" height="50px"
                        alt="<?php echo $admin_name; ?>">
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $admin_name; ?></div>
                    <div class="email"><small> <?php echo $_SESSION['online']; ?> </small></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                            style="color: #000;">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="settings.php"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>