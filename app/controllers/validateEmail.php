<?php

if (!empty($_GET['email'])) {
    $uname = $_GET['email'];
    $data['email_valid'] = $this->model('ValidateModel')->testEmail($email);
    if ($data['email_valid'] == 1) {
        echo "Email '$email' is exist! Please use another email";
    } else {
        echo "";
    }
}
