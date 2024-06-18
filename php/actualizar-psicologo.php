<?php
include 'vars.php';

$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = $data['id'];
    $nombre = $data['nombre'];
    $enfoque = $data['enfoque'];
    $telefono = $data['telefono'];
    $correo = $data['correo'];
    $rfc = $data['rfc'];

    try {
        $query = "UPDATE psicologos SET nombre = :nombre, enfoque = :enfoque, telefono = :telefono, correo = :correo, rfc = :rfc WHERE id = :id";
        $stmt = $conex->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':enfoque', $enfoque);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':rfc', $rfc);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        http_response_code(200);
        echo json_encode(["mensaje" => "Psicólogo actualizado exitosamente"]);
    } catch(PDOException $exc) {
        http_response_code(500);
        echo "Error al actualizar el psicólogo: " . $exc->getMessage();
    }
}
?>
