<?php
include 'vars.php';

// Verificar si viene el parámetro id en el cuerpo de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id'])) {
    http_response_code(400);
    exit("Falta el parámetro 'id' para eliminar la cita.");
}

try {
    $conex = new PDO("sqlite:" . $nombre_fichero);
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $idCita = $data['id'];

    // Preparar la consulta para eliminar la cita
    $stmt = $conex->prepare("DELETE FROM citas WHERE id = :id");
    $stmt->bindParam(':id', $idCita, PDO::PARAM_INT);
    $stmt->execute();

    http_response_code(200);
    echo json_encode(array('message' => 'Cita eliminada correctamente.'));

} catch(PDOException $exc) {
    http_response_code(500);
    echo "Error al eliminar la cita: " . $exc->getMessage();
}
?>
