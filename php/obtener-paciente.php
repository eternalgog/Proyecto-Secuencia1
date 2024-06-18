<?php
include 'vars.php';

$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $query = "SELECT * FROM pacientes WHERE id = :id";
        $stmt = $conex->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

        http_response_code(200);
        echo json_encode($paciente);
    } catch(PDOException $exc) {
        http_response_code(500);
        echo "Error al obtener el paciente: " . $exc->getMessage();
    }
}
?>
