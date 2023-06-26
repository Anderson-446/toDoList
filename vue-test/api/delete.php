<?php
require('config.php');
header('Access-Control-Allow-Headers: *');

    $conn = new PDO (
        "mysql:dbname=web_1_ipi; port=3307; host=localhost","root","root"
    );

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $idTarefa = $data['id'];

    $sql= 'DELETE FROM tarefas WHERE id = :id';

    $stmt = $conn-> prepare($sql);
    $stmt->bindParam(':id', $idTarefa); 
    $stmt -> execute();

?> 