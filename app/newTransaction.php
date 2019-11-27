<?php

function connDB($db_name)
{
    $servername = "54.227.125.161";
    $username = "root";
    $password = "";
    $dbname = $db_name;
  
    $conn = new mysqli($servername, $username, $password, $dbname);

    return $conn;
}

$conn = connDB("engima");
if (isset($_POST["seat_num"]) && isset($_POST["id_bioskop"])) {
    $seat_num = $_POST["seat_num"];
    $id_bioskop = $_POST["id_bioskop"];

    $query = "INSERT INTO booked_seats(id_bioskop, seat_num) VALUE (".$id_bioskop.",".$seat_num.")";
    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "" . mysqli_error($conn);
    }
}

$conn->close();