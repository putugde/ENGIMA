<?php

class HomeModel
{
    private $db;
    
    public function __construct()
    {
        $this->db = new database;
    }
    
    public function getAllFilm()
    {
        $this->db->query("SELECT DISTINCT id_film,judul,foto FROM (film NATURAL JOIN tayang) JOIN jadwal USING(id_jadwal) WHERE tanggal = CURRENT_DATE AND waktu > CURRENT_TIME");
        $this->db->bind('tanggal', 'CURRENT_DATE');
        $this->db->bind('waktu', 'CURRENT_TIME');
        return $this->db->resultSet();
    }
}
