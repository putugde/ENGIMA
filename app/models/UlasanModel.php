<?php

class UlasanModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDetailUlasan($id)
    {
        $this->db->query("SELECT rating, isi_ulasan FROM ulasan WHERE id_ulasan = '$id'");
        return $this->db->single();
    }
}
