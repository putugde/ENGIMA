<!DOCTYPE HTML>

<script type="text/javascript" src="<?php echo BASEURL; ?>/js/searchtable.js?=v2"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>/js/paginator.js?=v2"></script>
<link rel="stylesheet" href="<?php echo BASEURL; ?>/css/table.css?=v2">
    
<div class="isi">
    <h3> Showing search result for keyword "<?php echo $data["keyword"] ?>" </h3>
    <h4 style="color:grey"> <?php echo $data['count']; ?> results available  </h4>
    
    
    <div id="table_box"></div>
    <div id="index_native" class="box"></div>
    <script>
        var data = <?php echo json_encode($data) ?>;
        var BASEURL = "<?php echo BASEURL; ?>";
        console.log(data);
        window.addEventListener("load", function () {
            create_sample_table(document.getElementById("table_box"), true, data, BASEURL);
            paginator({
                table: document.getElementById("table_box").getElementsByTagName("table")[0],
                box: document.getElementById("index_native"),
                active_class: "color_page"
            });
        }, false);
        </script>
</div>
