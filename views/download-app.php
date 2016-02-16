<script>
setCookies(1, 'red_pg_shown');
setCookies(365);
</script>   
<div id="proposal">
    </div>
    <div id="proposal_buttons">
        <div id="googleplay">
            <a href="https://play.google.com/store/apps/details?id=com.womanfreebies&hl=en" target="_blank"
           onclick="setCookies(365, 'red_pg_android');window.location.href = document.location.search.replace('?', '');" >
            <img src="../img/redirectpage/button-get-it-on-google-play.png">
        </a>
        </div>
        <p align="center">
            <a onclick="setCookies(7, 'red_pg_skip');window.location.href = document.location.search.replace('?', '');" href="javascript: void(0);">SKIP AND USE MOBILE SITE</a>
        </p>
    </div>


<?php
$path = ('http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/show.app');
$count = file_get_contents($path) ? file_get_contents($path) : 0;
$count++; 

$file = fopen('../public/show.app', "w") or $count='Please set 777 to public/show.app';
fwrite($file, $count);
echo '<script>console.log("Total visits: ' . $count . '")</script>';
fclose($file);
