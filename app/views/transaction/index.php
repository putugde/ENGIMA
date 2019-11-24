<!DOCTYPE HTML>
<html lang="en">

<link rel="stylesheet" href="<?php echo BASEURL; ?>/css/transaction.css?=v2">
<input id="id_film" type="hidden" value="<?= $data["id_film"] ?>" />
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="message-container">
        <h1 id="header-popup">Transaction Has Been Made</h1>
        <span>Transaction #<span id="id_transaction"></span></span>
        <span>Transfer To : <span id="rekening_tujuan"></span></span>
        <div>
            <button id="go-to-transaction-history" class="btn-blue">Go To Transaction History</button>
        </div>
    </div>
  </div>
</div>
<div class="isi">
    <div class="flex-container">
        <div class="column">
            <div class="row" width = "50px">
                <a href="<?php echo BASEURL?>/film/index/<?php echo $data["id_film"] ?>"><img  src="<?php echo BASEURL ?>/img/back.jpg" width="30px"></a>
            </div>
        </div>
        <div class="kiri-bawah">
            <div class="row">
                <h3 id="nama-film"></h3>
                <h5 id="jadwal-film"><?php echo $data["jadwal"] ?></h5>
            </div>
        </div>
        <div class="kanan-bawah">

        </div>
    </div>
    <hr>
    <div class="flex-baru">
        <div class="kursi" id="kursi">
            <?php foreach ($data["tempat_duduk"] as $nomor_kursi => $terisi) : ?>
                <?php if ($terisi): ?>
                    <button class= "btn" id="test" disabled><?= $nomor_kursi;?></button>
                <?php else: ?>
                    <button class= "btn" id="test" ><?= $nomor_kursi;?></button>
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

<script type="text/javascript" src="<?php echo BASEURL; ?>/js/transaction_init.js"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>/js/transaction.js"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>/js/modal.js"></script>

<script type="text/javascript">
    var data = <?php echo json_encode($data, JSON_UNESCAPED_UNICODE); ?>;
    var url = "<?php echo BASEURL; ?>";
    window.addEventListener("load", function(){
        trans(data,url);
    }); 
</script>
