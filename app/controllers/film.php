<?php
class Film extends controller
{
    public function filmDetailAPI($film_id)
    {
        $curl = curl_init();
        $api_key = "5b7ea6ce4c5133d16eec87e0ea203efe";

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$film_id."?api_key=".$api_key."&language=en-US",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }
    }

    public function index($id)
    {
        $data["film"] = $this->filmDetailAPI($id);
        $data["title"] = "Movie Detail";
        $data["tanggal"] = date_create($data["film"]["release_date"]);
        $temp = $this->model('FilmModel')->getAvgEngimaRating($id);
        $data["film"]["eng_rating"] = round($temp[0]["avg"], 1);

        $list_jadwal = $this->model('FilmModel')->getListJadwal($id);
        $data["jadwal"] = [];
        $data["ulasan"] = [];

        foreach ($list_jadwal as $jadwal) {
            $count = $this->model('CinemaModel')->getBookedSeats($jadwal["id_bioskop"]);
            $data["id"] = $jadwal["id_bioskop"];
            $data["jadwal"][$jadwal["id_bioskop"]]["available"] = 30 - $count["jumlah"];
            $ts = strtotime($jadwal["jadwal_film"]);
            $data["jadwal"][$jadwal["id_bioskop"]]["tanggal"] = date("F d, Y", $ts);
            $data["jadwal"][$jadwal["id_bioskop"]]["waktu"] = date("H:i", $ts);
        }

        $list_ulasan = $this->model('CinemaModel')->getUlasan($id);
        foreach ($list_ulasan as $ulasan) {
            $data["ulasan"][$ulasan["id_review"]]["username"] = $ulasan["username"];
            $data["ulasan"][$ulasan["id_review"]]["profile_picture"] = $ulasan["profile_picture"];
            $data["ulasan"][$ulasan["id_review"]]["rating"] = $ulasan["rating"];
            $data["ulasan"][$ulasan["id_review"]]["isi_ulasan"] = $ulasan["content"];
        }

        $this->view('templates/header', $data);
        $this->view('film/index', $data);
        $this->view('templates/footer');
    }
}
