<?php
class Home extends controller
{
    public function index()
    {
        $data['title'] = "Home Page";
        $data['film'] = $this->filmAPI();
        $this->view('templates/header', $data);
        $this->view('home/index', $data, $_COOKIE);
        $this->view('templates/footer');
    }

    public function filmAPI()
    {
        $curl = curl_init();
        $dateNow = date("Y-m-d");
        $dateLastWeek = date("Y-m-d", strtotime("-1 week"));
        //echo $dateLastWeek;

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?primary_release_date.lte=" . $dateNow . "&primary_release_date.gte=" . $dateLastWeek . "&page=1&include_video=false&include_adult=false&sort_by=popularity.desc&language=en-US&api_key=" . API_KEY,
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
