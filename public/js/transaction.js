/*global console document XMLHttpRequest alert window DOMParser location*/
'use strict';

function createVirtualAccountXML(id_rekening) {

    return '<?xml version="1.0" encoding="UTF-8"?><S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">' +
            '<SOAP-ENV:Header/>' +
                '<S:Body>' +
                    '<ns2:createVirtualAccount xmlns:ns2="http://services.bankpro.com/">' +
                        '<id_rekening xmlns="">' + id_rekening + '</id_rekening>' +
                    '</ns2:createVirtualAccount>' +
                '</S:Body>' +
            '</S:Envelope>';
}

function beli(data) {
    var createNewVirtual = new XMLHttpRequest();
    var rekeningVirtual;

    createNewVirtual.onerror = function () {
        alert("Cannot make new virtual account");
    };
    createNewVirtual.onreadystatechange = function () {
        if (createNewVirtual.readyState === 4 && createNewVirtual.status === 200) {
            var parser = new DOMParser();
            var XMLDoc = parser.parseFromString(createNewVirtual.responseText, "text/xml");
            rekeningVirtual = XMLDoc.getElementsByTagName("return")[0].textContent;

            var createTransaction = new XMLHttpRequest();
            createTransaction.onerror = function () {
                alert("Cannot make new transaction");
            };
            createTransaction.onreadystatechange = function () {
                if (createTransaction.readyState === 4 && createTransaction.status === 200) {
                    var responseJSON = JSON.parse(createTransaction.responseText);
                    var id_transaction = document.getElementById("id_transaction");
                    id_transaction.innerText = responseJSON.ID;
                    var rekening_tujuan = document.getElementById("rekening_tujuan");
                    rekening_tujuan.innerText = rekeningVirtual;
                    var modal = document.getElementById("myModal");
                    modal.style.display = "block";
                }
            };
            createTransaction.open("POST", "http://ec2-54-226-75-201.compute-1.amazonaws.com:8080/api/transaction", true);
            createTransaction.setRequestHeader('Content-Type', 'application/json');
            createTransaction.send(JSON.stringify({
                "idUser": 1,
                "akunTujuan": rekeningVirtual,
                "idFilm": data.id_film,
                "jadwalFilm": data.jadwal_raw,
                "nomorKursi": data.dipilih,
                "id_bioskop": data.id_jadwal
            }));
        }
    };
    createNewVirtual.open("POST", "http://ec2-54-226-75-201.compute-1.amazonaws.com:8081/WebServiceBank/services/RekeningService?wsdl", true);
    createNewVirtual.setRequestHeader("SOAPAction", '""');
    createNewVirtual.setRequestHeader("Content-Type", "text/xml");
    createNewVirtual.send(createVirtualAccountXML(2));
}

function lagi(data, ignore) {
    var kalau = document.getElementsByClassName("kalau");

    var judul = document.createElement("h4");
    judul.innerHTML = document.getElementById("nama-film").innerHTML;
    judul.setAttribute("style", "color:black;margin-bottom:10px");

    var tanggal = document.createElement("h5");
    tanggal.innerHTML = document.getElementById("jadwal-film").innerHTML;
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

    tombol.addEventListener("click", function () {
        beli(data);
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
    Array.prototype.forEach.call(btns, function (item, ignore) {
        item.addEventListener("click", function () {
            var current = document.getElementsByClassName("btn_active");
            data.dipilih = item.innerHTML;
            if (current.length > 0) {
                current[0].className = current[0].className.replace("btn_active", "btn");
            }
            item.className += "_active";
            lagi(data, url);
        });
    });
}
