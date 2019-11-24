<?php

class Transaction extends controller
{
    public function index($id_jadwal)
    {
        $data["jadwal"] = [];
        $data["tempat_duduk"] = [];
        $data["film"] = [];

        $data["title"] = "Transaction";

        $id_film = $this->model('CinemaModel')->getIdFilm($id_jadwal);
        $film = $this->model('FilmModel')->getFilm($id_film["id_film"]);
        $data["film"] = $film;
        $jadwal = $this->model('CinemaModel')->getJadwal($id_jadwal);
        $data["jadwal"]["id_jadwal"] = $id_jadwal;
        $data["jadwal"]["tanggal"] = date_format(date_create($jadwal["tanggal"]), "F d, Y");
        $data["jadwal"]["waktu"] = date_format(DateTime::createFromFormat("H:i:s", $jadwal["waktu"]), "h:i a");
        $tempat_duduk = $this->model('CinemaModel')->getTempatDuduk($id_jadwal);
        foreach ($tempat_duduk as $key => $td) {
            $data["tempat_duduk"][$key]["no_kursi"] = $td["no_kursi"];
            $data["tempat_duduk"][$key]["terisi"] = $td["terisi"];
        }
        
        $this->view('templates/header', $data);
        $this->view('transaction/index', $data);
        $this->view('templates/footer');
    }

    public function buy($id, $id_j)
    {
        $this->model('CinemaModel')->updateIsi($id, $id_j);
        $this->model('CinemaModel')->updateMenonton($_COOKIE['uname'], $id, $id_j);
        echo($id);
    }
}
