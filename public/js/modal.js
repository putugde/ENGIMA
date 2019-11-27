/*global document window */
'use strict';

// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var btnGo = document.getElementById('go-to-transaction-history');

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
        window.location.reload();
    }
};

btnGo.onclick = function (ignore) {
    window.location.href = 'http://54.172.93.9/engima/app/transactionhistory.php';
};