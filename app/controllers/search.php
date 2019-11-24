<?php

class Search extends controller
{
    public function index()
    {
        $data['title'] = "Search Result";
        $data['film'] = $this->model('FilmModel')->getAllFilm();
        $data['page'] = intdiv(count($data['film']), 5) + 1;
        $this->view('templates/header', $data);
        $this->view('search/index', $data);
        $this->view('templates/footer');
    }

    public function result()
    {
        $data['title'] = "Search Result";
        $data['keyword'] = $_POST['keyword'];
        $data['film'] = $this->searchAPI($data['keyword']);
        $data['count'] = count($data['film']['results']);
        $this->view('templates/header', $data);
        $this->view('search/index', $data);
        $this->view('templates/footer');
    }

    public function searchAPI($keyword)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?include_adult=false&page=1&query=" . $keyword . "&language=en-US&api_key=" . API_KEY,
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
}
