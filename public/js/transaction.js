/*global console document XMLHttpRequest alert window*/
'use strict';

function beli(url) {
    var xhr = new XMLHttpRequest();

    xhr.onerror = function () {
        alert("gagal");
    };

    xhr.onloadend = function () {
        console.log(xhr.responseText);
        if (xhr.responseText !== "") {
            alert("Payment Success, Thank you for purchasing, You can view your purchase now");
            window.location.href = 'http://localhost/engima/app/transactionhistory.php';
        }
    };

    xhr.open("POST", url, true);
    xhr.send();
}

function lagi(data, url) {
    var kalau = document.getElementsByClassName("kalau");

    var judul = document.createElement("h4");
    judul.innerHTML = data.film.judul;
    judul.setAttribute("style", "color:black;margin-bottom:10px");

    var tanggal = document.createElement("h5");
    tanggal.innerHTML = data.jadwal.tanggal + " - " + data.jadwal.waktu;
    tanggal.setAttribute("style", "color:grey;margin-top:10px;margin-bottom:10px");

    var dipilih = document.createElement("h4");
    dipilih.innerHTML = "Seat #" + data.dipilih;
    dipilih.setAttribute("style", "color:black;margin-top:10px");

    var uang = document.createElement("h4");
    uang.setAttribute("style", "color:black;margin-top:10px");
    uang.innerHTML = "Rp45.000,00";

    var span1 = document.createElement("span");
    span1.setAttribute("class", "seat");
    span1.appendChild(dipilih);

    var span2 = document.createElement("span");
    span2.setAttribute("class", "harga");
    span2.appendChild(uang);

    var div1 = document.createElement("div");
    div1.appendChild(span1);
    div1.appendChild(span2);

    var tombol = document.createElement("button");
    tombol.innerHTML = "Buy Ticket";
    tombol.setAttribute("class", "buy-ticket");

    var new_url = url + "/transaction/buy/" + data.dipilih + "/" + data.jadwal.id_jadwal;

    tombol.addEventListener("click", function () {
        beli(new_url);
    });

    var div2 = document.createElement("div");
    div2.appendChild(tombol);

    kalau[0].innerHTML = "";
    kalau[0].appendChild(judul);
    kalau[0].appendChild(tanggal);
    kalau[0].appendChild(div1);
    kalau[0].appendChild(div2);
}

function trans(data, url) {
    var header = document.getElementById("kursi");
    var btns = header.getElementsByClassName("btn");
    btns.forEach(function (item, ignore) {
        item.addEventListener("click", function () {
            var current = document.getElementsByClassName("btn_active");
            console.log(item.innerHTML);
            data.dipilih = item.innerHTML;
            if (current.length > 0) {
                current[0].className = current[0].className.replace("btn_active", "btn");
            }
            item.className += "_active";
            lagi(data, url);
            console.log(data);
        });
    });
}
