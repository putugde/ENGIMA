<?php

class Login extends controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function auth()
    {
        $email = $psw = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $psw = $_POST["psw"];
            $data['valid'] = $this->model('UserModel')->validateAcc($email, $psw);
            if ($data['valid']) {
                $cookie_name = 'uname';
                $cookie_value = $data['valid']['username'];
                setcookie($cookie_name, $cookie_value, time() + 86400, "/"); // 86400 = 1 day
                header('Location: ../home/index');
            } else {
                header('Location: ../');
            }
        }
    }
}
