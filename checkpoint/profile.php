<?php
$sql = $conn->prepare(" SELECT * FROM `tbl_place` WHERE `place_id` = '" . $_SESSION['user_id'] . "'  ");
$sql->execute();
while ($fetch = $sql->fetch()) {
    $place_id = $fetch['place_id'];
    $place_name = $fetch['place_name'];
    $fileName = "../images/avatar5.png";
}
?>
<div class="user-info">
    <div class="image">
        <img src="../images/avatar5.png" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $place_name; ?></div>
        <div class="email"><small> <?php echo $_SESSION['online']; ?> </small></div>
        <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                style="color: #000;">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
                <li><a href="my_profile.php"><i class="material-icons">person</i>Profile</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="../logout.php"><i class="material-icons">input</i>Sign Out</a></li>
            </ul>
        </div>
    </div>
</div>