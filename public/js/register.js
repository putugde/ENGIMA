/*global XMLHttpRequest document console*/
'use strict';

var uname_valid = false;
var email_valid = false;
var phone_valid = false;
var valid = false;
var uname = document.forms.form.uname;
var email = document.forms.form.email;
var phone = document.forms.form.phone;

function flag(status, id, msg) {
    var elmt = document.getElementById(id);
    if (status) {
        elmt.classList.remove("false");
        elmt.classList.add("true");
        document.getElementById(id).innerHTML = '';
    } else {
        elmt.classList.remove("true");
        elmt.classList.add("false");
        document.getElementById(id).innerHTML = msg;
    }
}

function checkUname() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            flag(xhr.responseText === 1, "mark_uname", "Username " + uname.value + " is exist! Please use another username");
            if (xhr.responseText === 1) {
                uname.style.border = "1px solid green";
                valid = true;
            } else {
                uname.style.border = "1px solid #dedede";
                valid = false;
            }
            uname_valid = xhr.responseText === 0;
        }
    };
    if (uname.value.match(/^[a-zA-Z0-9_]+$/)) {
        xhr.open('POST', 'register/validateUname');
        xhr.setRequestHeader("Content-Type", "application/json");
        var data = JSON.stringify({"uname": uname.value});
        xhr.send(data);
    } else {
        uname.style.border = "1px solid #dedede";
        flag(false, "mark_uname", "must contain only alphanumeric and/or underscore");
        valid = true;
    }
}

function checkEmail() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            flag(xhr.responseText === 1, "mark_email", "Email " + email.value + " is exist! Please use another email");
            if (xhr.responseText === 1) {
                email.style.border = "1px solid green";
                valid = true;
            } else {
                email.style.border = "1px solid #dedede";
                valid = false;
            }
            uname_valid = xhr.responseText === 0;
        }
    };
    if (email.value.match(/(?:[a-z0-9!#$%&'*+\/=?\^_`{\|}~-\]+(?:\.\[a-z0-9!#$%&'*+\/=?\^_`{\|}~\-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*"\)@(?:(?:[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9\-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/g)) {
        xhr.open('POST', "register/validateEmail");
        xhr.setRequestHeader("Content-Type", "application/json");
        var data = JSON.stringify({"email": email.value});
        xhr.send(data);
    } else {
        email.style.border = "1px solid #dedede";
        flag(false, "mark_email", "invalid email format");
        valid = false;
    }
}

function checkPhone() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            flag(xhr.responseText === 1, "mark_phone", "Phone number " + phone.value + " is exist! Please use another phone number");
            if (xhr.responseText === 1) {
                phone.style.border = "1px solid green";
                valid = true;
            } else {
                phone.style.border = "1px solid #dedede";
                valid = false;
            }
            phone_valid = xhr.responseText === 0;
        }
    };
    if (phone.value.match(/^(\d{9}|\d{12})$/)) {
        xhr.open('POST', 'register/validatePhone');
        xhr.setRequestHeader("Content-Type", "application/json");
        var data = JSON.stringify({"phone": phone.value});
        xhr.send(data);
    } else {
        email.style.border = "1px solid #dedede";
        flag(false, "mark_phone", "must be 9-12 digits");
        valid = false;
    }
}

function checkPassword() {
    console.log("YUHU");
    //alert(YUHU);
    var psw1 = document.forms.form.psw1;
    var psw2 = document.forms.form.psw2;
    if (psw1.value === psw2.value) {
        psw1.style.border = "1px solid green";
        psw2.style.border = "1px solid green";
        flag(true, "mark_psw");
        valid = true;
    } else {
        flag(false, "mark_psw", "password is different");
        valid = false;
    }
}

function checkValid() {
    return valid;
}

function browseFile() {
    var realButton = document.getElementById("realbtn");
    var browseButton = document.getElementById("browsebtn");
    var customText = document.getElementById("text");
    browseButton.addEventListener("click", function () {
        realButton.click();
    });
    realButton.addEventListener("change", function () {
        if (realButton.value) {
            if (realButton.value.match(/\.(gif|jpg|jpeg|tiff|png)$/i)) {
                customText.innerHTML = realButton.value;
                customText.style.border = "1px solid green";
            } else {
                customText.innerHTML = "must be image";
                customText.style.border = "1px solid red";
            }
        } else {
            customText.innerHTML = "no file";
        }
    });
}
