/*global console document*/
'use strict';
var tbody;

function create_sample_table(parentNode, body, data, url) {
    var temp = data.film;
    console.log(temp);
    if (body === undefined) {
        body = true;
    }

    data = {
        "body": temp
    };

    var table = document.createElement("table");
    var tr;

    tr = document.createElement("tr");

    var headers = data.head || [];

    headers.forEach(function (item, ignore) {
        var th = document.createElement("th");
        th.setAttribute("class", "table_box");
        th.innerHTML = item;
        tr.appendChild(th);
    });

    table.appendChild(tr);

    if (body) {
        tbody = document.createElement("tbody");
    }

    temp.forEach(function (item, ignore) {
        var src = item.foto;

        var img = document.createElement("img");
        img.setAttribute("src", url + "/img/" + src);
        img.setAttribute("height", "250px");

        var td1 = document.createElement("td");
        td1.setAttribute("class", "table_box");
        td1.setAttribute("rowspan", "3");
        td1.appendChild(img);

        var th1 = document.createElement("th");
        th1.setAttribute("class", "film_title");
        th1.innerHTML = item.judul;

        var td2 = document.createElement("td");
        td2.setAttribute("rowspan", "3");
        td2.setAttribute("class", "link");
        td2.setAttribute("width", "200px");

        var icon = document.createElement("img");
        icon.setAttribute("src", url + "/img/next.jpg");
        icon.setAttribute("width", "20px");
        icon.setAttribute("height", "20px");

        var link = document.createElement("a");
        link.innerHTML = "View Details ";
        link.setAttribute("class", "link_detail");
        link.setAttribute("href", url + "/film/index/" + item.id_film);
        link.appendChild(icon);

        var div = document.createElement("div");
        div.appendChild(link);
        td2.appendChild(div);

        var tr1 = document.createElement("tr");
        tr1.appendChild(td1);
        tr1.appendChild(th1);
        tr1.appendChild(td2);

        tbody.appendChild(tr1);

        var tr2 = document.createElement("tr");

        var td3 = document.createElement("td");
        td3.setAttribute("class", "rating");
        td3.setAttribute("width", "900px");

        icon = document.createElement("img");
        icon.setAttribute("src", url + "/img/star.png");
        icon.setAttribute("width", "20px");
        icon.setAttribute("height", "20px");

        var span = document.createElement("span");
        td3.appendChild(icon);

        var th2 = document.createElement("th");
        th2.setAttribute("class", "rating");
        th2.innerHTML = item.rate;

        span.appendChild(icon);
        span.appendChild(th2);

        td3.appendChild(span);
        tr2.appendChild(td3);
        tbody.appendChild(tr2);

        var tr3 = document.createElement("tr");
        var td4 = document.createElement("td");
        td4.setAttribute("class", "description");
        td4.setAttribute("width", "900px");
        td4.innerHTML = item.deskripsi;
        tr3.appendChild(td4);

        tbody.appendChild(tr3);
    });

    if (body) {
        table.appendChild(tbody);
    }

    if (parentNode) {
        parentNode.appendChild(table);
    }
}
