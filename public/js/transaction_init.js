/*global document XMLHttpRequest alert*/
"use strict";
var xhr = new XMLHttpRequest();
var idFilm = document.getElementById('id_film').value;
var judul = document.getElementById('nama-film');

xhr.onerror = function () {
    alert("gagal");
};

xhr.onloadend = function () {
    if (xhr.status === 404) {
        judul.innerText = "Movie not found";
    } else if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        judul.innerText = response.title;
    }
};

xhr.open("GET", "https://api.themoviedb.org/3/movie/" + idFilm + "?api_key=0403d2e947af1a00d4e75059d0dae372", true);
xhr.send();
