<?php
include 'vars.php';

# Verificar si vienen los parámetros requeridos
if (empty($_POST["paciente"])) {
    http_response_code(400);
    exit("Falta nombre del paciente"); # Terminar el script definitivamente
}

if (empty($_POST["fecha"])) {
    http_response_code(400);
    exit("Falta fecha"); # Terminar el script definitivamente
}
if (empty($_POST["hora"])) {
    http_response_code(400);
    exit("Falta hora"); # Terminar el script definitivamente
}
if (empty($_POST["psicologo"])) {
    http_response_code(400);
    exit("Falta psicólogo"); # Terminar el script definitivamente
}
if (empty($_POST["motivo"])) {
    http_response_code(400);
    exit("Falta motivo"); # Terminar el script definitivamente
}

try {
    $conex = new PDO("sqlite:" . $nombre_fichero);
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $cita = [
        "paciente" => $_POST["paciente"],
        "fecha" => $_POST["fecha"],
        "hora" => $_POST["hora"],
        "psicologo" => $_POST["psicologo"],
        "motivo" => $_POST["motivo"]
    ];

    # Preparando la consulta de inserción
    $sentencia = $conex->prepare("INSERT INTO citas (paciente, fecha, hora, psicologo, motivo) VALUES (:paciente, :fecha, :hora, :psicologo, :motivo);");
    $resultado = $sentencia->execute($cita);
    
    if ($resultado) {
        http_response_code(200);
        echo "Datos insertados correctamente.";

        # Redirigir a index.html después de 2 segundos
        header("Refresh: 2; URL=../index.html");
        exit();
    }
} catch(PDOException $exc) {
    http_response_code(500); // Error de servidor
    echo "Lo siento, ocurrió un error: " . $exc->getMessage();
}
?>
