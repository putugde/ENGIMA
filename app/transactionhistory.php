<?php

function filmAPI($film_id)
{
    $curl = curl_init();
    $api_key = "5b7ea6ce4c5133d16eec87e0ea203efe";

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.themoviedb.org/3/movie/".$film_id."?api_key=".$api_key."&language=en-US",
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

function transactionAPI($user_id)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "54.227.125.161:8080/api/transaction/".$user_id,
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

function updateStatusCancelled($ts_id) {
    $curl = curl_init();

    $data = array(
        'status' => 'Cancelled',
    );
    $payload = json_encode($data);

    curl_setopt_array($curl, array(
        CURLOPT_URL => "54.227.125.161:8080/api/transaction/".$ts_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => $payload,
    ));

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload))
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        return json_decode($response, true);
    }
}



function connDB($db_name)
{
    $servername = "54.227.125.161";
    $username = "root";
    $password = "";
    $dbname = $db_name;
  
    $conn = new mysqli($servername, $username, $password, $dbname);

    return $conn;
}

function closeDB($conn)
{
    $conn -> close();
}

$conn = connDB("engima");
$sql = "SELECT id_user FROM users WHERE username = '".$_COOKIE['uname']."'";
$id_user = mysqli_query($conn, $sql);
$id_user = mysqli_fetch_all($id_user);
$id_user = $id_user[0][0];

$response = transactionAPI($id_user);

$dataFilm = [];
if ($response["message"] == "Error") {
    echo ("Failed to get data from database");
} else {
    $response = $response["data"];
    // foreach ($response[0] as $key => $value) {
    //     echo "Key: $key; Value: $value\n";
    // }
    foreach ($response as $res) {
        $dataFilm[$res["id_film"]] = filmAPI($res["id_film"]);
        $transaction_time = new DateTime($res["waktu_transaksi"], new DateTimezone('Asia/Jakarta'));
        $transaction_time->modify('+2 minutes');
        $now = new DateTime('now', new DateTimezone('Asia/Jakarta'));
        if (($transaction_time < $now) and ($res["status_transaksi"] == 'Pending')) {
            updateStatusCancelled($res["id_transaksi"]);
            $res["id_transaksi"] = 'Cancelled';
        }
    }
}

$reviewData = [];

foreach ($response as $res) {
    $sql = "SELECT * FROM review WHERE id_bioskop = ".$res["id_bioskop"]." AND id_user = ".$res["id_user"];
    $temp =  mysqli_query($conn, $sql);
    $reviewData[$res["id_transaksi"]] = mysqli_fetch_assoc($temp);
}
closeDB($conn);
?>


<!DOCTYPE HTML>
<html lang="en">

    <head>
        <title>Transaction History</title>
        <link rel="stylesheet" href="../public/css/transactionhistory.css">
        <link rel="stylesheet" href="../public/css/styles.css">
        <link rel="stylesheet" href="../public/css/bar.css">
    </head>
    
    <body>
        <div class="top">
            <header class="header">
                <table id="bar">
                    <tr>
                        <td class="left">
                            <div class="row">
                                <p class="name">
                                    <a href="http://54.172.93.9/engima/public/home">
                                        <button class="backhome" type="button">
                                            <span class="newblue"><b>Engi</b></span>
                                            <span class="black"><b>ma</b></span>
                                        </button>
                                    </a>
                                </p>
                            </div>
                            <div class="row">
                                <form action="http://54.172.93.9/engima/public/search/result" method="post" class="searchbox">
                                    <input type="text" name="keyword" placeholder="Search movie">
                                    <span>
                                        <input id="searchbtn" type="image" class="search" src="../public/img/search.png">
                                    </span>                                 
                                </form>
                            </div>
                        </td>
                        <td class="right">
                            <div class="row">
                                <a href="http://54.172.93.9/engima/public/logout/index">
                                    <button class="button" type="button">Logout</button>
                                </a>
                                <a href="http://54.172.93.9/engima/app/transactionhistory.php">
                                    <button class="button" type="button">Transaction</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </header>
        </div>
        <div class="bottom">
            <div class="homebox">
                <div class="isi">
                    <div class="judul"><p>Transaction History</p></div>
                    <div class="transHis">
                        <ol reversed class="listFilm">
                            <?php
                            foreach ((array)$response as $isi) :
                                $date = new DateTime($isi["jadwal_film"], new DateTimezone('Asia/Jakarta'));
                                $time = new DateTime($isi["jadwal_film"], new DateTimezone('Asia/Jakarta'));
                                $date1 = new DateTime($isi["jadwal_film"], new DateTimezone('Asia/Jakarta'));
                                $now = new DateTime('now', new DateTimezone('Asia/Jakarta'));
                                ?>
                                <li class="containerFilm">
                                    <img class="" src="<?php echo "https://image.tmdb.org/t/p/w185". $dataFilm[$isi["id_film"]]["poster_path"] ?>" width="120" height="160">
                                    <div class="descBox">
                                        <div class="nama">
                                            <p class="namaFilm">
                                                <?php
                                                    echo $dataFilm[$isi["id_film"]]["title"]
                                                ?>
                                            </p>
                                        </div>
                                        <br>
                                        <div class="schedule">
                                            <p class="jadwal">Schedule: </p>
                                            <p class="jadwalFilm">
                                                <?php
                                                    echo date_format($date, 'F d, Y - ');
                                                    echo date_format($time, 'h:i A');
                                                ?>
                                            </p>
                                            <p class="jadwal">Status: </p>
                                            <p class="jadwalFilm">
                                                <?php
                                                    echo $isi["status_transaksi"];
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                    if ($date1 < $now and $isi["status_transaksi"] == 'Success') {
                                        if (!(is_countable($reviewData[$isi["id_transaksi"]]))) {?>
                                            <div class="tombolAdd">
                                            <!-- ganti jd id bioskop jgn lupa goblook -->
                                                <a href="userReview.php?id_bioskop=<?php echo $isi["id_bioskop"]?>">
                                                    <button class="addReview" type="button">Add Review</button>
                                                </a>
                                            </div>
                                            <?php
                                        } else { ?>
                                            <div class="tombolDel">
                                            <!-- ganti jd id bioskop jgn lupa goblook -->
                                                <a href="userReview.php?id_bioskop=<?php echo $isi["id_bioskop"]?>&action=delete">
                                                    <button class="delReview" type="button">Delete Review</button>
                                                </a>
                                            </div>
                                            <div class="tombolEdit">
                                            <!-- ganti jd id bioskop jgn lupa goblook -->
                                                <a href="userReview.php?id_bioskop=<?php echo $isi["id_bioskop"]?>">
                                                    <button class="editReview" type="button">Edit Review</button>
                                                </a>
                                            </div>
                                            <?php
                                        }?>
                                        <?php
                                    }?>
                                </li>
                                <hr>
                                <?php
                            endforeach
                            ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
