<?php

class KategoriModel
{
    private $table = 'kategori';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getNamaKategori($id)
    {
        $this->db->query("SELECT nama_kategori FROM kategori WHERE id_kategori = '$id'");
        return $this->db->resultSet();
    }
}
