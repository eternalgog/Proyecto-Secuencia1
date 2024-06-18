<?php
include 'vars.php';

# Verificar si vienen los parámetros requeridos
if (empty($_POST["nombre"])) {
    http_response_code(400);
    exit("Falta nombre del paciente");
}

if (empty($_POST["telefono"])) {
    http_response_code(400);
    exit("Falta teléfono");
}
if (empty($_POST["direccion"])) {
    http_response_code(400);
    exit("Falta dirección");
}
if (empty($_POST["email"])) {
    http_response_code(400);
    exit("Falta correo electrónico");
}
if (empty($_POST["edad"])) {
    http_response_code(400);
    exit("Falta edad");
}
if (empty($_POST["genero"])) {
    http_response_code(400);
    exit("Falta género");
}

$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$paciente = [
    "nombre" => $_POST["nombre"],
    "telefono" => $_POST["telefono"],
    "direccion" => $_POST["direccion"],
    "email" => $_POST["email"],
    "edad" => $_POST["edad"],
    "genero" => $_POST["genero"]
];

try {
    # Preparando la consulta
    $sentencia = $conex->prepare("INSERT INTO pacientes (nombre, telefono, direccion, email, edad, genero) VALUES (:nombre, :telefono, :direccion, :email, :edad, :genero);");
    $resultado = $sentencia->execute($paciente);
    if ($resultado) {
        http_response_code(200);
        echo "Paciente insertado correctamente.";

        # Redirigir a index.html después de 2 segundos
        header("Refresh: 2; URL=../index.html");
        exit();
    }
} catch(PDOException $exc) {
    http_response_code(500); // Error de servidor
    echo "Lo siento, ocurrió un error: " . $exc->getMessage();
}

?>
