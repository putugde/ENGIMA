<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title><?php echo $data['title']; ?></title>
        <!--<link rel="stylesheet" href="../../public/css/styles.css?=v2">
        <link rel="stylesheet" href="../../public/css/bar.css?=v2">
        <link rel="stylesheet" href="../../public/css/home.css?=v2">-->
        <link rel="stylesheet" href="<?php echo BASEURL; ?>/css/styles.css?=v2">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>/css/bar.css?=v2">
    </head>
    <body>
        <div class="top">
            <header class="header">
                <table id="bar">
                    <tr>
                        <td class="left">
                            <div class="row">
                                <p class="name">
                                    <a href="<?php echo BASEURL; ?>/home">
                                        <button class="backhome" type="button">
                                            <span class="newblue"><b>Engi</b></span>
                                            <span class="black"><b>ma</b></span>
                                        </button>
                                    </a>
                                </p>
                            </div>
                            <div class="row">
                                <form action="<?php echo BASEURL; ?>/search/result" method="post" class="searchbox">
                                    <input type="text" name="keyword" placeholder="Search movie">
                                    <span>
                                        <input id="searchbtn" type="image" class="search" src="<?php echo BASEURL; ?>/img/search.png">
                                    </span>
                                </form>
                            </div>
                        </td>
                        <td class="right">
                            <div class="row">
                                <a href="<?php echo BASEURL; ?>/logout/index">
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
