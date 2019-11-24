<?php
if (!isset($_COOKIE['uname'])) {
    header('Location: ../public');
    die;
}
?>

<!DOCTYPE HTML>

<html>
    <head>
        <link rel="stylesheet" href="<?php echo BASEURL; ?>/css/login_styles.css?=v2">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>/css/home.css?=v2">
    </head>
    <body>
        <div class="isi">
            <div class="title">
                <div class="row">
                    <span class="hello">Hello, </span>
                    <span id="name"><?php echo $_COOKIE["uname"]; ?></span>
                    <span class="hello">!</span>
                </div>
            </div>
            <div class="subtitle">
                <div class="row">
                    <h3>Now Playing</h3>
                </div>
            </div>
            <div class="content" id="">
                <?php foreach ($data['film'] as $film) : ?>
                <div id="film">
                    <div class="photo">
                        <a href="<?php echo BASEURL; ?>/film/index/<?php echo $film['id_film']; ?>"><img class="poster" src="<?php echo BASEURL; ?>/img/<?php echo $film['foto'] ?>" alt="<?php echo $film['judul'] ?>"></a>
                    </div>
                    <div class="filmtitle">
                        <a href="#"><p><?php echo $film['judul'] ?></p></a>
                    </div>
                    <div class="rating">
                        <img id="star" src="<?php echo BASEURL; ?>/img/star.png">
                        <span id="value">10</span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
