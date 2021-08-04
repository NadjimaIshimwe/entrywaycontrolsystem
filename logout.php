<?php include 'includes/header.php'; ?>
<?php include 'links.php'; ?>

<section class="site-section-light site-section-top themed-background-default">

    <div class="container">
        <h3 class="text-center animation-slideDown"><i class="fa fa-user"></i> <strong>Logout</strong></h3>

    </div>
</section>


<section class="site-content site-section">
    <div class="container">
        <?php
        $tm = date("Y-m-d H:i:s");

        if (isset($_SESSION['sess_id']) and isset($_SESSION['username'])) {

            $logout_user = $db->prepare("update tbl_user_session set time_logout=?,status=? where sess_id=?");
            try {
                // insert into tbl_personal_ug
                $logout_user->execute(array($tm, 'OFF', $_SESSION['sess_id']));
                // end to update
                $name = strtoupper($_SESSION['username']);


                session_unset();
                session_destroy();



                echo "<br /><br /><center><font face='Verdana' size='2' >Dear <b>" . $name . "</b>, You have successfully logged out. <br /><br /><br /></font></center>";

                echo "<br /><br /><center><font face='Verdana' size='2' > <a href='index.php'>Go to!</a><br /><br /><br /></font></center>";
                echo '<meta http-equiv="refresh"' . 'content="3;URL=index.php">';
            } catch (PDOException $ex) {
                //Something went wrong rollback!
                echo $ex->getMessage();
            }
        } else {
            echo "<br><center> <font face='Verdana' size='2' color=red>No User Data. Use your login and try!. <br/><br/><br/> </center><br><center><input type='button' value='Retry' onClick='history.go(-1)'></font></center>";

            echo '<meta http-equiv="refresh"' . 'content="3;URL=index.php">';
        }

        ?>
        <br>
        <!-- END form Content -->
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
</section>


<?php
include 'script.php';
?>