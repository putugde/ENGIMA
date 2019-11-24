<?php

if (!empty($_GET['phone'])) {
    $phone = $_GET['phone'];
    $data['phone_valid'] = $this->model('ValidateModel')->testPhone($phone);
    if ($data['phone_valid'] == 1) {
        echo "Phone number '$phone' is exist! Please use another phone number";
    } else {
        echo "";
    }
}
