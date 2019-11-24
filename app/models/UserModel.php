<?php

class UserModel
{
    private $db;
    private $res;
    
    public function __construct()
    {
        $this->db = new database;
    }
    
    public function validateAcc($email, $psw)
    {
        $this->db->query("SELECT email, password, username FROM users WHERE email='$email' AND password='$psw'");
        $this->db->bind('email', $email);
        $this->db->bind('password', $psw);
        $res = $this->db->single();
        return $res;
    }

    public function validateUname($uname)
    {
        $this->db->query("SELECT uname FROM users WHERE username='$uname'");
        $this->db->bind('username', $uname);
        $res = $this->db->single();
        if ($res) {
            return 0;
        } else {
            if (preg_match('/^[a-zA-Z0-9_]+$/', $uname)) {
                return 1;                                   //uname unik dan karakternya bener
            } else {
                return 2;                                   //gasesuai syarat
            }
        }
    }

    public function validateEmail($email)
    {
        $this->db->query("SELECT email FROM users WHERE email='$email'");
        $this->db->bind('email', $email);
        $res = $this->db->single();
        if ($res) {
            return 0;
        } else {
            return 1;                                   //email unik
        }
    }

    public function validatePhone($phone)
    {
        $this->db->query("SELECT phone_number FROM users WHERE phone_number='$phone'");
        $this->db->bind('phone_number', $phone);
        $res = $this->db->single();
        if ($res) {
            return 0;
        } else {
            if (preg_match('/^(\d{10}|\d{12})$/', $phone)) {
                return 1;                                   //email unik
            } else {
                return 2;                                   //gasesuai syarat
            }
        }
    }

    public function validatePassword($psw1, $psw2)
    {
        if ($psw1 == $psw2) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getProfilePicture($user)
    {
        $this->db->query("SELECT profile_picture FROM users WHERE username = '$user'");
        return $this->db->single();
    }
    
    public function addNewUser($uname, $email, $phone, $psw, $picture)
    {
        $this->db->query("INSERT INTO users(username, email, phone_number, password, profile_picture) VALUES ('$uname','$email','$phone','$psw','$picture')");
        $this->db->execute();
        return $this->db->rowCount();
    }
}
