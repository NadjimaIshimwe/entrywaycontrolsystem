<?php
include 'includes/header.php';
include 'includes/links.php';

?>


<body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);"><img src="images/icon_log.png" border="0" width="100"
                    style="border-radius: 50%;"></a><br>
            <small>
                <h3>Reset Password</h3>
            </small>
        </div>
        <div class="card">
            <div class="body">
                <form id="forgot_password" action="forgot-pass-check" method="POST">
                    <div class="msg">
                        Enter your phone-number that you used to register. We'll send you a message with your username
                        and a
                        code to reset your password.
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">telephone</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="user_tel" maxlength="15" placeholder="Tel"
                                required autofocus>
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" name="reset_password">RESET
                        MY PASSWORD</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="index">Sign In!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('includes/js.php'); ?>
</body>

</html>