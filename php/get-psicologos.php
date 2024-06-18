<?php
include 'vars.php';

try {
    $conex = new PDO("sqlite:" . $nombre_fichero);
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conex->prepare("SELECT nombre FROM psicologos");
    $stmt->execute();
    $psicologos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($psicologos);
} catch(PDOException $exc) {
    http_response_code(500);
    echo "Error en la conexión: " . $exc->getMessage();
}
?>
