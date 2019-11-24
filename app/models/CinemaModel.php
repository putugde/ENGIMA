<?php

class CinemaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAvailableChair($id)
    {
        $this->db->query("SELECT COUNT(no_kursi) as jumlah FROM tempat_duduk WHERE id_jadwal = '$id' AND terisi = 0");
        return $this->db->single();
    }

    public function getJadwal($id)
    {
        $this->db->query("SELECT tanggal, waktu FROM jadwal WHERE id_jadwal = '$id'");
        return $this->db->single();
    }

    public function getUlasan($id)
    {
        $this->db->query("SELECT username, id_ulasan FROM memberi WHERE id_jadwal = '$id'");
        return $this->db->resultSet();
    }

    public function getIdFilm($id)
    {
        $this->db->query("SELECT id_film FROM tayang WHERE id_jadwal = '$id'");
        return $this->db->single();
    }

    public function updateIsi($id, $id_j)
    {
        $this->db->query("UPDATE tempat_duduk SET terisi = 1 WHERE id_jadwal = '$id_j' AND no_kursi = '$id'");
        $this->db->execute();
    }

    public function updateMenonton($uname, $id, $id_j)
    {
        $this->db->query("INSERT INTO menonton VALUE ('$uname', '$id_j', '$id')");
        $this->db->execute();
    }
    public function getTempatDuduk($id)
    {
        $this->db->query("SELECT no_kursi, terisi FROM tempat_duduk WHERE id_jadwal = '$id'");
        return $this->db->resultSet();
    }
}
