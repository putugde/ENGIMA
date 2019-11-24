<?php

class FilmModel
{
    private $table = 'film';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllFilm()
    {
        $this->db->query('SELECT * FROM '. $this->table);
        return $this->db->resultSet();
    }

    public function getFilm($id)
    {
        $this->db->query("SELECT * FROM film WHERE id_film = '$id'");
        return $this->db->convert($this->db->single());
    }

    public function getIdKategori($id)
    {
        $this->db->query("SELECT id_kategori FROM termasuk WHERE id_film = '$id'");
        return $this->db->resultSet();
    }

    public function getIdJadwal($id)
    {
        $this->db->query("SELECT id_bioskop FROM bioskop WHERE id_film  = '$id';");
        return $this->db->resultSet();
    }

    public function getListJadwal($id)
    {
        $this->db->query("SELECT * FROM bioskop WHERE id_film  = '$id';");
        return $this->db->resultSet();
    }
    
    public function getResultFilm()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM film WHERE judul LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->convert($this->db->resultSet());
    }

    public function getAvgEngimaRating($id)
    {
        $this->db->query("SELECT AVG(rating) AS 'avg' FROM bioskop JOIN review ON bioskop.id_bioskop = review.id_bioskop  WHERE id_film  = '$id';");
        return $this->db->resultSet();
    }
}
