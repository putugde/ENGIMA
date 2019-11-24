<?php
class Film extends controller
{
    public function index($id)
    {
        $data["title"] = "Movie Detail";
        $id_kategori = [];
        $data["film"] =  $this->model('FilmModel')->getFilm($id);
        $data["tanggal"] = date_create($data["film"]["tanggal_rilis"]);
        $id_kategori = $this->model('FilmModel')->getIdKategori($id);
        foreach ($id_kategori as $key => $id_k) {
            $data["nama_kategori"][$key] = $this->model('KategoriModel')->getNamaKategori($id_k["id_kategori"]);
        }
        $id_jadwal = $this->model('FilmModel')->getIdJadwal($id);
        $data["jadwal"] = [];
        $data["ulasan"] = [];
        foreach ($id_jadwal as $key => $id_j) {
            $count = $this->model('CinemaModel')->getAvailableChair($id_j["id_jadwal"]);
            $data["jadwal"][$key]["id"] = $id_j["id_jadwal"];
            $data["jadwal"][$key]["available"] = $count["jumlah"];
            $jadwal =$this->model('CinemaModel')->getJadwal($id_j["id_jadwal"]);
            $data["jadwal"][$key]["tanggal"] = date_create($jadwal["tanggal"]);
            $data["jadwal"][$key]["waktu"] = DateTime::createFromFormat("H:i:s", $jadwal["waktu"]);
            
            $ulasan = $this->model('CinemaModel')->getUlasan($id_j["id_jadwal"]);
            foreach ($ulasan as $key => $ul) {
                $data["ulasan"][$key]["username"] = $ul["username"];
                $foto = $this->model('UserModel')->getProfilePicture($ul["username"]);
                $data["ulasan"][$key]["profile_picture"] = $foto["profile_picture"];
                $detailUlasan = $this->model('UlasanModel')->getDetailUlasan($ul["id_ulasan"]);
                $data["ulasan"][$key]["rating"] = $detailUlasan["rating"];
                $data["ulasan"][$key]["isi_ulasan"] = $detailUlasan["isi_ulasan"];
            }
        }
        $this->view('templates/header', $data);
        $this->view('film/index', $data);
        $this->view('templates/footer');
    }
}
