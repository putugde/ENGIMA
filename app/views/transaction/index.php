<!DOCTYPE HTML>
<html lang="en">

<link rel="stylesheet" href="<?php echo BASEURL; ?>/css/transaction.css?=v2">

<div class="isi">
    <div class="flex-container">
        <div class="column">
            <div class="row" width = "50px">
                <a href="<?php echo BASEURL?>/film/index/<?php echo $data["film"]["id_film"] ?>"><img  src="<?php echo BASEURL ?>/img/back.jpg" width="50px"></a>
            </div>
        </div>
        <div class="kiri-bawah">
            <div class="row">
                <h3> <?php echo $data["film"]["judul"] ?> </h3>
                <h5> <?php echo $data["jadwal"]["tanggal"]?> - <?php echo $data["jadwal"]["waktu"] ?> </h5> 
            </div>
        </div>
        <div class="kanan-bawah">

        </div>
    </div>
    <hr>
    <div class="flex-baru">
        <div class="kursi" id="kursi">
            <?php foreach ($data["tempat_duduk"] as $key => $kursi) : ?>
                <?php if ($kursi["terisi"]) : ?>
                    <button class= "btn" id="test" disabled><?php echo $key+1;?></button>
                <?php else : ?>
                    <button class= "btn" id="test" ><?php echo $key+1;?></button>
                <?php endif; ?>
            <?php endforeach ?>

            <button class=screen disabled>screen</button>
        </div>
        <div class=vl></div>
        <div class=hitung>
            <div class="booking">
                Booking Summary
            </div> 
            <div class="kalau">
                You Havent' selected any seat yet. Please click on one of the seat provided
            </div>
        </div>
    </div>    
</div>

<script type="text/javascript" src="<?php echo BASEURL; ?>/js/transaction.js?=v2"></script>

<script type="text/javascript">
    var data = <?php echo json_encode($data, JSON_UNESCAPED_UNICODE); ?>;
    var url = "<?php echo BASEURL; ?>";
    window.addEventListener("load", function(){
        trans(data,url);
    }); 
</script>
