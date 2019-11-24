<!--

yang kurang:
1. nyimpen review

-->

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

function connDB()
{
    $servername = "54.226.75.201";
    $username = "root";
    $password = "";
    $dbname = "engima";
  
    $conn = new mysqli($servername, $username, $password, $dbname);

    return $conn;
}

function closeDB($conn)
{
    $conn -> close();
}

if (!(isset($_GET['id_bioskop']) || isset($_POST['id_bioskop']))) {
    header('Location: transactionhistory.php');
} else if (isset($_GET['id_bioskop']) and !isset($_POST['id_bioskop']) and !isset($_GET['action'])) { //saat sebelum klik submit atau edit

    $idBioskop = $_GET['id_bioskop'];
    $conn = connDB();

    $sql = "SELECT id_film FROM bioskop WHERE id_bioskop = ".$idBioskop;
    $res = mysqli_query($conn, $sql);
    $res = mysqli_fetch_all($res);

    $idFilm = $res[0][0];

    $temp_film = filmAPI($idFilm);

    $judul = $temp_film["title"];

    $sql = "SELECT id_user FROM users WHERE username = '".$_COOKIE['uname']."'";
    $id_user = mysqli_query($conn, $sql);
    $id_user = mysqli_fetch_all($id_user);
    $id_user = $id_user[0][0];

    //DAH SAMPE SINI

    $isi_review = null;
    $id_ulasan = null;
    $rating = null;

    //ini nyari judul, content, id review, sama rating
    $sql = "SELECT * FROM review WHERE id_user=".$id_user." AND id_bioskop = ".$idBioskop;
    $response = mysqli_query($conn, $sql);

    //response handler
    if ($response) {
        $response = mysqli_fetch_all($response);
        foreach ($response as $isi) {
            $isi_review = $isi[4];
            $id_ulasan = $isi[0];
            $rating = $isi[3];
        }
    }

} else { //saat sudah klik submit atau edit
    //submit, edit, del review handler
    $uname = $_COOKIE['uname']; //ambil username dari cookie
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = connDB();
        $idBioskop = $_POST['id_bioskop'];

        $sql = "SELECT id_user FROM users WHERE username = '".$_COOKIE['uname']."'";
        $id_user = mysqli_query($conn, $sql);
        $id_user = mysqli_fetch_all($id_user);
        $id_user = $id_user[0][0];

        $sql = "SELECT id_review FROM review WHERE id_bioskop = ". $_POST["id_bioskop"] ." AND id_user = ". $id_user;
        $id_review = mysqli_query($conn, $sql);
        $id_review = mysqli_fetch_all($id_review);

        if (empty($id_review)) { //maka insert sql
            if (isset($_POST['rating']) && isset($_POST['isiReview'])) {
                $rating = $_POST['rating'];
                $isi_review = $_POST['isiReview'];
                
                $sql = "INSERT INTO review(id_user, id_bioskop, rating, content) VALUES(".$id_user.",".$idBioskop.",".$rating.",'".$isi_review."');";
                $conn->query($sql);
            }
            header('Location: transactionhistory.php');
        } else { //maka update sql
            if (isset($_POST['rating']) && isset($_POST['isiReview'])) {
                $rating = $_POST['rating'];
                $isi_review = $_POST['isiReview'];
                $sql = "UPDATE review SET rating = " .$rating .", content = '" .$isi_review ."' 
                WHERE id_review = " .$id_review[0][0] ."";

                $conn->query($sql);
            }
            header('Location: transactionhistory.php');
        }
    } else {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'delete') {
                $conn = connDB();
                $sql = "SELECT id_user FROM users WHERE username = '".$_COOKIE['uname']."'";
                $id_user = mysqli_query($conn, $sql);
                $id_user = mysqli_fetch_all($id_user);
                $id_user = $id_user[0][0];

                $sql = "SELECT id_review FROM review WHERE id_bioskop = ". $_GET["id_bioskop"] ." AND id_user = ". $id_user;
                $id_review = mysqli_query($conn, $sql);
                $id_review = mysqli_fetch_all($id_review);
                $id_review = $id_review[0][0];

                $sql = "DELETE FROM review WHERE id_review = " .$id_review;
                mysqli_query($conn, $sql);
            }
            header('Location: transactionhistory.php');
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
    
    <head>
        <title>User Review</title>
        <link rel="stylesheet" href="../public/css/styles.css">
        <link rel="stylesheet" href="../public/css/bar.css">
        <link rel="stylesheet" href="../public/css/userReview.css">
        <link rel="stylesheet" href="../public/css/stars.css">
    </head>
    
    <body>
        <div class="top">
            <header class="header">
                <table id="bar">
                    <tr>
                        <td class="left">
                            <div class="row">
                                <p class="name">
                                    <a href="http://localhost/engima/public/home">
                                        <button class="backhome" type="button">
                                            <span class="newblue"><b>Engi</b></span>
                                            <span class="black"><b>ma</b></span>
                                        </button>
                                    </a>
                                </p>
                            </div>
                            <div class="row">
                                <form action="http://localhost/engima/public/search/result" method="post" class="searchbox">
                                    <input type="text" name="keyword" placeholder="Search movie">
                                    <span>
                                        <input id="searchbtn" type="image" class="search" src="../public/img/search.png">
                                    </span>                                 
                                </form>
                            </div>
                        </td>
                        <td class="right">
                            <div class="row">
                                <a href="http://localhost/engima/public/logout/index">
                                    <button class="button" type="button">Logout</button>
                                </a>
                                <a href="http://localhost/engima/app/transactionhistory.php">
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
                    <div class="filmReview">
                        <button class="back" type="button">
                            <a href="transactionhistory.php">
                                <img src="../public/img/back.png" width="30" height="30">
                            </a>
                        </button>
                        <h1 class="namaFilm">
                            <?php
                            echo $judul
                            ?>
                        </h1>
                        <br>
                        <form class="rev" action="userReview.php" method="post">
                            <div class="revRatBox">
                                <div class="addRating">
                                    <h2 class="nama">Add Rating</h2>
                                    <div class="bintang">
                                    <?php
                                    if (is_null($rating)) {?>
                                        <ul class="rate-area">
                                            <input type="radio" id="10-star" name="rating" value="10"/><label for="10-star">10 stars</label>
                                            <input type="radio" id="9-star" name="rating" value="9"/><label for="9-star">9 stars</label>
                                            <input type="radio" id="8-star" name="rating" value="8"/><label for="8-star">8 stars</label>
                                            <input type="radio" id="7-star" name="rating" value="7"/><label for="7-star">7 stars</label>
                                            <input type="radio" id="6-star" name="rating" value="6"/><label for="6-star">6 star</label>
                                            <input type="radio" id="5-star" name="rating" value="5"/><label for="5-star">5 stars</label>
                                            <input type="radio" id="4-star" name="rating" value="4"/><label for="4-star">4 stars</label>
                                            <input type="radio" id="3-star" name="rating" value="3"/><label for="3-star">3 stars</label>
                                            <input type="radio" id="2-star" name="rating" value="2"/><label for="2-star">2 stars</label>
                                            <input type="radio" id="1-star" name="rating" value="1"/><label for="1-star">1 star</label>
                                        </ul> <?php
                                    } else {?>
                                        <ul class="rate-area">
                                            <input type="radio" id="10-star" name="rating" value="10" <?php echo $rating==10 ? 'checked' : ''?>/><label for="10-star">10 stars</label>
                                            <input type="radio" id="9-star" name="rating" value="9" <?php echo $rating==9 ? 'checked' : ''?>/><label for="9-star">9 stars</label>
                                            <input type="radio" id="8-star" name="rating" value="8" <?php echo $rating==8 ? 'checked' : ''?>/><label for="8-star">8 stars</label>
                                            <input type="radio" id="7-star" name="rating" value="7" <?php echo $rating==7 ? 'checked' : ''?>/><label for="7-star">7 stars</label>
                                            <input type="radio" id="6-star" name="rating" value="6" <?php echo $rating==6 ? 'checked' : ''?>/><label for="6-star">6 star</label>
                                            <input type="radio" id="5-star" name="rating" value="5" <?php echo $rating==5 ? 'checked' : ''?>/><label for="5-star">5 stars</label>
                                            <input type="radio" id="4-star" name="rating" value="4" <?php echo $rating==4 ? 'checked' : ''?>/><label for="4-star">4 stars</label>
                                            <input type="radio" id="3-star" name="rating" value="3" <?php echo $rating==3 ? 'checked' : ''?>/><label for="3-star">3 stars</label>
                                            <input type="radio" id="2-star" name="rating" value="2" <?php echo $rating==2 ? 'checked' : ''?>/><label for="2-star">2 stars</label>
                                            <input type="radio" id="1-star" name="rating" value="1" <?php echo $rating==1 ? 'checked' : ''?>/><label for="1-star">1 star</label>
                                    </ul>
                                    <?php }
                                    ?>
                                    </div>
                                </div>
                                <div class="addReview">
                                    <h2 class="nama">Add Review</h2>
                                    <div class="review">
                                        <textarea name="isiReview"><?php echo $isi_review ?></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="id_bioskop" value="<?php echo $idBioskop?>">
                                <a href="transactionhistory.php">
                                    <button class="cancel" type="button">Cancel</button>
                                </a>
                                <?php
                                if (is_null($id_ulasan)) {?>
                                    <button class="submit" type="submit">Submit</button> <?php
                                } else {?>
                                    <button class="edit" type="submit">Edit</button>
                                <?php }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
    
