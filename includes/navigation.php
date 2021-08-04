<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <title><?php echo $title; ?> -<?php include('../inc/title.php');?></title>
    <?php include('links.php');?>
</head>

 <?php include('topbar.php');?>
    <section>
        <!-- Left Sidebar -->
         <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <?php include('user_info.php');?>
            <!-- #User Info -->
            
            <!-- Menu -->
            <?php include('menu.php');?>
            <!-- #Menu -->
            
            <!-- Footer -->
            <?php include('footer.php');?>
            <!-- #Footer -->
        </aside>
    </section>
    
    
    <?php include('js.php');?>  
    </body>
</html>