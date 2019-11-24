<?php

if (!empty($_GET['uname'])) {
    $uname = $_GET['uname'];
    $data['uname_valid'] = $this->model('ValidateModel')->testUname($uname);
    if ($data['uname_valid'] == 1) {
        echo "Username '$uname' is exist! Please use another username";
    } else {
        echo "";
    }
}
