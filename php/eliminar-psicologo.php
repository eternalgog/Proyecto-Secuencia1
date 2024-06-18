<?php
include 'vars.php';

// Verificar si se recibió el ID del psicólogo por POST
$data = json_decode(file_get_contents("php://input"));

if(isset($data->id)) {
    $idPsicologo = $data->id;
    
    try {
        $conex = new PDO("sqlite:" . $nombre_fichero);
        $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "DELETE FROM psicologos WHERE id = :id";
        $stmt = $conex->prepare($query);
        $stmt->bindParam(':id', $idPsicologo, PDO::PARAM_INT);
        $stmt->execute();

        http_response_code(200);
        echo json_encode(["message" => "Psicólogo eliminado correctamente"]);

    } catch(PDOException $exc) {
        http_response_code(500);
        echo json_encode(["error" => "Error al eliminar psicólogo: " . $exc->getMessage()]);
    }

} else {
    http_response_code(400);
    echo json_encode(["error" => "ID de psicólogo no proporcionado"]);
}
?>
