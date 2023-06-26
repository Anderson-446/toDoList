<?php
require ('config.php');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

    $conn = new PDO (
        "mysql:dbname=web_1_ipi; port=3307; host=localhost","root","root"
    );

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $desc = $data['descricao'];

    $sql = "INSERT INTO tarefas (descricao) VALUES (:descricao)";


    $stmt = $conn-> prepare($sql);
    $stmt->bindParam(':descricao', $desc); 
    $stmt -> execute();
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

?> 