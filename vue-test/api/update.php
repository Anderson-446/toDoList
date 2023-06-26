<?php
require('config.php');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');



$json = file_get_contents('php://input');
$data = json_decode($json, true);

$id = $data['id'];
$updates = $data['updates'];

$sql = 'UPDATE tarefas SET done = :newDone WHERE id=:id';
try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':newDone', $updates);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?> 