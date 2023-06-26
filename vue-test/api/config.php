<?php
    header("Access-Control-Allow-Origin: *");

    $conn = new PDO (
        "mysql:dbname=web_1_ipi; port=3307; host=localhost","root","root"
    );

?> 