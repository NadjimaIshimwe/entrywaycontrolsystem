<?php include './includes/header.php'; ?>
<?php include 'links.php'; ?>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a><img src="images/entry_logo_only.png"
                    style="width: 120px; height: 120px; border-radius: 50%; object-fit: contain;"></a><br>
            <small>
                <h3>EntryWay Control</h3>
            </small>
        </div>
        <div class="card" style="background: rgba(255, 255, 255, 0.9)">
            <div class="body">
                <?php
                if (isset($_REQUEST['msg'])) {
                ?>
                <TABLE align='center'>
                    <TR>
                        <TD>
                            <FONT SIZE="3" COLOR="red"><strong><?php echo $_REQUEST['msg']; ?></strong></FONT>
                        </TD>
                    </TR>
                </TABLE>
                <?php
                }
                ?>
                <form id="sign_in" action="login_query.php" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="login-username" placeholder="Username"
                                value="<?php if (isset($_COOKIE["login-username"])) {
                                                                                                                            echo $_COOKIE["login-username"];
                                                                                                                        } ?>" required autofocus style="background: rgba(255, 255, 255, 0)">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="login-password" placeholder="Password"
                                value="<?php if (isset($_COOKIE["login-password"])) {
                                                                                                                                echo $_COOKIE["login-password"];
                                                                                                                            } ?>"
                                required style="background: rgba(255, 255, 255, 0)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="remember" class="filled-in chk-col-pink">
                            <label for="remember">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit" name="loginbtn">SIGN
                                IN</button>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-xs-6">
                            <a href="sign-up.php"><i class="fa fa-pencil-square-o"></i> Register Now!</a>
                        </div> -->

                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.php"><i class="fa fa-key"></i> Forgot Password?</a>
                        </div>

                    </div>

                    <div class="row m-t-15 m-b--20">
                        <!-- <div class="col-xs-6 align-right">-->
                        <!--<a href="add_my_property.php">Add my property</a>-->
                        <!--</div>-->

                        <div class="col-xs-6">
                            <a href="#"><i class="fa fa-android"></i> Android App</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include './js.php'; ?>
</body>

</html>