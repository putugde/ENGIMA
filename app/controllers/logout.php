<?php
class Logout extends controller
{
    public function index()
    {
        unset($_COOKIE['uname']);
        setcookie('uname', null, time() - 86400, '/');
        header('Location: ../login/index');
    }
}
