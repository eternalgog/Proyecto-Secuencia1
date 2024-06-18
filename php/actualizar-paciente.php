<?php
include 'vars.php';

$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = $data['id'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono'];
    $direccion = $data['direccion'];
    $email = $data['email'];
    $edad = $data['edad'];
    $genero = $data['genero'];

    try {
        $query = "UPDATE pacientes SET nombre = :nombre, telefono = :telefono, direccion = :direccion, email = :email, edad = :edad, genero = :genero WHERE id = :id";
        $stmt = $conex->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        http_response_code(200);
        echo json_encode(["mensaje" => "Paciente actualizado exitosamente"]);
    } catch(PDOException $exc) {
        http_response_code(500);
        echo "Error al actualizar el paciente: " . $exc->getMessage();
    }
}
?>
