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
        $data['film'] = $this->model('FilmModel')->getResultFilm();
        $data['count'] = count($data['film']);
        $this->view('templates/header', $data);
        $this->view('search/index', $data);
        $this->view('templates/footer');
    }
}
