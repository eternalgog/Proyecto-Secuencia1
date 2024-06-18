<?php
include 'vars.php';

$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $query = "SELECT * FROM citas";
    $stmt = $conex->query($query);
    $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(200);
    echo json_encode($citas);
} catch(PDOException $exc) {
    http_response_code(500);
    echo "Error al obtener las citas: " . $exc->getMessage();
}
?>
