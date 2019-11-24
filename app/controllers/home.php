<?php
class Home extends controller
{
    public function index()
    {
        $data['title'] = "Home Page";
        $data['film'] = $this->model('HomeModel')->getAllFilm();
        $this->view('templates/header', $data);
        $this->view('home/index', $data, $_COOKIE);
        $this->view('templates/footer');
    }
}
