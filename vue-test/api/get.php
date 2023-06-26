<?php
require('config.php');

    $conn = new PDO (
        "mysql:dbname=web_1_ipi; port=3307; host=localhost","root","root"
    );

    $result = $conn->query('SELECT * FROM tarefas');

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

?> 