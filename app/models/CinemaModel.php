<?php

class CinemaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getBookedSeats($id)
    {
        $this->db->query("SELECT COUNT(seat_num) as jumlah FROM booked_seats WHERE id_bioskop = '$id'");
        return $this->db->single();
    }

    public function getJadwal($id)
    {
        $this->db->query("SELECT jadwal_film FROM bioskop WHERE id_bioskop = '$id'");
        return $this->db->single();
    }

    public function getUlasan($id)
    {
        $this->db->query("SELECT * FROM review JOIN bioskop ON review.id_bioskop = bioskop.id_bioskop JOIN users ON review.id_user = users.id_user WHERE bioskop.id_film = '$id'");
        return $this->db->resultSet();
    }

    public function getIdFilm($id)
    {
        $this->db->query("SELECT id_film FROM bioskop WHERE id_bioskop = '$id'");
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
        $this->db->query("SELECT seat_num FROM booked_seats WHERE id_bioskop = '$id'");
        return $this->db->resultSet();
    }
}
