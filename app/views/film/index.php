<link rel="stylesheet" href="<?php echo BASEURL; ?>/css/film.css?=v2">

<div class="isi">
    <div class="row-atas">
        <div class="column_poster">
            <img src=<?php echo "https://image.tmdb.org/t/p/w200". $data["film"]["poster_path"] ?> height="250px" >
        </div>
        <div class="column_detail">
            <div class="row-judul">
                <h2><?php echo $data["film"]["title"] ?></h2>
            </div>
            <div class="row-kategori">
                <?php foreach ($data["film"]["genres"] as $genre) : ?>
                    <?php if ($genre != 0) : ?>
                    <?php endif; ?>
                    <?php echo $genre["name"]; ?>
                <?php endforeach; ?>
                | <?php echo $data["film"]["runtime"] ?> mins
            </div>
            <div class="row-release">
                Release date: <?php echo date_format($data["tanggal"], "F d, Y") ?>
            </div>
            <div class="row-rating">
                <img src="<?php echo BASEURL; ?>/img/star.png" width="25px">
                <?php echo $data["film"]["vote_average"]."/ 10 (The Movie DB) | " ?> 
                <img src="<?php echo BASEURL; ?>/img/star.png" width="25px">
                <?php echo $data["film"]["eng_rating"]."/ 10 (Engima)" ?> 
            </div>
            <div class="row-description">
                <?php echo $data["film"]["overview"] ?>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <div class="infobox">
            <div class="infobox-judul">
                Schedule
            </div>
            <table class="schedule-table">
                <tr> 
                    <th> Date </th>
                    <th> Time </th>
                    <th> Available Seats </th>
                    <th></th>
                </tr>
                <?php foreach ($data["jadwal"] as $key => $jadwal) : ?>
                    <tr>
                        <td class="info"> <?php echo $jadwal["tanggal"] ?> </td>
                        <td class="info"> <?php echo $jadwal["waktu"] ?> </td>
                        <td class="info"> <?php echo $jadwal["available"] ?> </td>
                        <td class="info"> 
                            <?php if ($jadwal["available"]) : ?>
                                <div class="buy"><a href="<?php echo BASEURL ?>/transaction/index/<?php echo $jadwal["id"] ?>"> Available <img src="<?php echo BASEURL ?>/img/next.jpg" width="16px"> </a></div>
                            <?php else : ?>
                                <div class="not-available"> Not Available <img src="<?php echo BASEURL ?>/img/cross.jpg" width="16px"> </div>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>   
            </table>    
        </div>
        <div class="review">
            <div class="review-judul">
                Reviews
            </div>
            <table class="review">
                <?php if (count($data["ulasan"])) : ?>
                    <?php foreach ($data["ulasan"] as $key => $ulasan) : ?>
                        <tr>
                            <td class="review" rowspan="3"><img class="bulat" src="<?php echo BASEURL?>/img/<?php echo $ulasan["profile_picture"] ?>" width="50px">  </td>
                            <td class="review" > <?php echo $ulasan["username"] ?> </td>
                        </tr>
                        <tr>
                            <td class="rating"><img src="<?php echo BASEURL?>/img/star.png" width="16px"><?php echo $ulasan["rating"] ?> / 10 </td>
                        </tr>
                        <tr>
                            <td class="isi"><?php echo $ulasan["isi_ulasan"] ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
        </div>
    </div>
</div>

<script>
    var data = <?php echo json_encode($data) ?>;
    console.log(data);
</script>
