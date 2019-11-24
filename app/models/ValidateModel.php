<?php

class ValidateModel
{
    private $db;
    private $res;
    
    public function __construct()
    {
        $this->db = new database;
    }

    public function testEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email='$email'");
        $this->db->bind('email', $email);
        $res = $this->db->single();
        if ($res) {
            return 0;                   //tidak unik
        } else {
            return 1;                   //unik
        }
    }

    public function testUname($uname)
    {
        $this->db->query("SELECT * FROM users WHERE username='$uname'");
        $this->db->bind('username', $uname);
        $res = $this->db->convert($this->db->single());
        if ($res) {
            return 0;
        } else {
            return 1;
        }
    }

    public function testPhone($phone)
    {
        $this->db->query("SELECT * FROM users WHERE phone_number='$phone'");
        $this->db->bind('phone', $phone);
        $res = $this->db->single();
        if ($res) {
            return 0;
        } else {
            return 1;
        }
    }
}
