<?php
include 'vars.php';

# Verificar si vienen los parámetros requeridos
if (empty($_POST["nombre"])) {
    http_response_code(400);
    exit("Falta nombre del psicólogo");
}

if (empty($_POST["enfoque"])) {
    http_response_code(400);
    exit("Falta enfoque del psicólogo");
}

if (empty($_POST["telefono"])) {
    http_response_code(400);
    exit("Falta teléfono del psicólogo");
}

if (empty($_POST["correo"])) {
    http_response_code(400);
    exit("Falta correo electrónico del psicólogo");
}

if (empty($_POST["rfc"])) {
    http_response_code(400);
    exit("Falta RFC del psicólogo");
}

$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$psicologo = [
    "nombre" => $_POST["nombre"],
    "enfoque" => $_POST["enfoque"],
    "telefono" => $_POST["telefono"],
    "correo" => $_POST["correo"],
    "rfc" => $_POST["rfc"]
];

try {
    # Preparando la consulta
    $sentencia = $conex->prepare("INSERT INTO psicologos (nombre, enfoque, telefono, correo, rfc) VALUES (:nombre, :enfoque, :telefono, :correo, :rfc);");
    $resultado = $sentencia->execute($psicologo);
    if ($resultado) {
        http_response_code(200);
        echo "Psicólogo insertado correctamente.";

        # Redirigir a index.html después de 2 segundos
        header("Refresh: 2; URL=../index.html");
        exit();
    }
} catch(PDOException $exc) {
    http_response_code(500); // Error de servidor
    echo "Lo siento, ocurrió un error: " . $exc->getMessage();
}

?>
