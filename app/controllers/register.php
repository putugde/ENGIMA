<?php
class Register extends controller
{
    public function index()
    {
        $this->view('register/index');
    }

    public function validateEmail()
    {
        $dataJSON = file_get_contents('php://input');
        $data = json_decode($dataJSON, true);
        $email = $data['email'];
        $data['email_valid'] = $this->model('ValidateModel')->testEmail($email);
        if ($data['email_valid'] == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function validatePhone()
    {
        $dataJSON = file_get_contents('php://input');
        $data = json_decode($dataJSON, true);
        //echo json_last_error_msg();
        $phone = $data['phone'];
        $data['phone_valid'] = $this->model('ValidateModel')->testPhone($phone);
        if ($data['phone_valid'] == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function validateUname()
    {
        $dataJSON = file_get_contents('php://input');
        $data = json_decode($dataJSON, true);
        $uname = $data['uname'];
        $data['uname_valid'] = $this->model('ValidateModel')->testUname($uname);
        header("Content-Type: application/json");
        if ($data['uname_valid'] == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function regist()
    {
        $uname = $email = $phone = $psw = $picture = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uname = $_POST['uname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $psw = $_POST['psw1'];
            $picture = $_POST['picture'];
            $data['success'] =  $this->model('UserModel')->addNewUser($uname, $email, $phone, $psw, $picture);
            if ($data['success'] == 1) {
                $cookie_name = 'uname';
                $cookie_value = $uname;
                setcookie($cookie_name, $cookie_value, time() + 86400, "/"); // 86400 = 1 day
                header('Location: ../home/index');
            } else {
                header('Location: ../');
            }
        }
    }
}
