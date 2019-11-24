<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo BASEURL; ?>/css/login_styles.css?=v2">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>/css/user.css?=v2">
    </head>
    <body>
        <div class="loginbox">
            <div class="content">
                <form action="<?php echo BASEURL; ?>/login/auth" method='post'>
                    <h1 class="heading">Welcome to <b>Engi</b>ma!</h1>
                    <div class="title">
                        <div class="row">
                            <p>Email</p>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="row">
                            <input type="email" name="email" placeholder="john@doe.com">
                        </div>
                    </div>
                    <div class="title">
                        <div class="row">
                            <p>Password</p>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="row">
                            <input type="password" name="psw" placeholder="place here">
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" name="submit" value="Login">
                    </div>
                </form>
                <div class="row">
                    <h2 class="noacc">Don't have an account? <a href="<?php echo BASEURL; ?>/register">Register here</a></h2>
                </div>
            </div>
        </div>
    </body>
</html>
