<!DOCTYPE HTML>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="<?php echo BASEURL; ?>/css/login_styles.css?=v2">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>/css/user.css?=v2">
    </head>
    <body>
        <div class="loginbox">
            <div class="content">
                <form action="<?php echo BASEURL; ?>/register/regist" method='post' name="form" onsubmit = "return checkValid()">
                    <h1 class="heading">Welcome to <b>Engi</b>ma!</h1>
                    <div class="title">
                        <div class="row">
                            <p>Username</p>k
                        </div>
                    </div>
                    <div class="entry">
                        <div class="row">
                            <input type="text" id="uname" name="uname" placeholder="joe.johndoe" onkeyup="checkUname()"> <!--onkeyup--->
                            <p id="mark_uname"></p>
                        </div>
                    </div>
                    <div class="title">
                        <div class="row">
                            <p>Email Address</p>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="row">
                            <input type="email" id="email" name="email" placeholder="john@email.com" onkeyup="checkEmail()"> <!--onkeyup--->
                            <p id="mark_email"></p>
                        </div>
                    </div>
                    <div class="title">
                        <div class="row">
                            <p>Phone Number</p>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="row">
                            <input type="tel" id="phone" name="phone" placeholder="+62813xxxxxxxx" onkeyup="checkPhone()"> <!--onkeyup--->
                            <p id="mark_phone"></p>
                        </div>
                    </div>
                    <div class="title">
                        <div class="row">
                            <p>Password</p>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="row">
                            <input type="password" id="psw1" name="psw1" placeholder="make as strong as possible" onkeyup="checkPassword()">
                            <p id="mark_psw"></p>
                        </div>
                    </div>
                    <div class="title">
                        <div class="row">
                            <p>Confirm Password</p>
                        </div>
                    </div>
                    <div class="entry">
                        <div class="row">
                            <input type="password" id="psw2" name="psw2" placeholder="same as above" onkeyup="checkPassword()">
                            <p id="mark_psw"></p>
                        </div>
                    </div>
                    <div class="title">
                        <div class="row">
                            <p>Profile Picture</p>
                        </div>
                    </div>
                    <div id="entry">
                        <table class="profpic">
                            <tr>
                                <td class="picture" id="text"></td>
                                <td class="browse">
                                    <input id="realbtn" type="file" hidden="hidden" name="picture"/>
                                    <button id="browsebtn" type="button" onclick="browseFile()">Browse</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <input type="submit" name="submit" value="Register" onclick="">
                    </div>
                </form>
                <div class="row">
                    <h2 class="noacc">Already have account? <a href="<?php echo BASEURL; ?>">Login here</a></h2>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo BASEURL; ?>/js/register.js"></script>
</html>
