<?php

class Transaction extends controller
{
    public function index($id_bioskop)
    {
        $jadwal = $this->model('CinemaModel')->getJadwal($id_bioskop); # Get datetime bioskop YYYY-MM-DD HH:MM:SS
        $id_film = $this->model('CinemaModel')->getIdFilm($id_bioskop); # Get id film from one bioskop
        $tempat_duduk = $this->model('CinemaModel')->getTempatDuduk($id_bioskop);
        
        $data["title"] = "Transaction";
        $data["jadwal_raw"] = $jadwal["jadwal_film"];
        $data["jadwal"] = date_format(date_create($jadwal["jadwal_film"]), "F d, Y - h:i A");
        $data["id_jadwal"] = $id_bioskop;
        $data["id_film"] = $id_film["id_film"];
        $kursi_bioskop = array_fill(1, 30, false);
        foreach ($tempat_duduk as $kursi) {
             $kursi_bioskop[$kursi["seat_num"]] = true;
        }
        $data["tempat_duduk"] = $kursi_bioskop;
        
        $this->view('templates/header', $data);
        $this->view('transaction/index', $data);
        $this->view('templates/footer');
    }
}
