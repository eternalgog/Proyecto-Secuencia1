<?php
include 'vars.php';

#verificar si veinen losparametros requeridos
if (empty($_POST["id"])) {
    http_response_code(400);
	exit("Falta id"); #Terminar el script definitivamente
}

if (empty($_POST["matricula"])) {
    http_response_code(400);
	exit("Falta umatricula"); #Terminar el script definitivamente
}

if (empty($_POST["nombre"])) {
    http_response_code(400);
	exit("falta nombre"); #Terminar el script definitivamente
}
if (empty($_POST["carrera"])) {
    http_response_code(400);
	exit("falta carrera"); #Terminar el script definitivamente
}
//
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$alumno=[
    "id"=> $_POST["id"],
    "matricula"=> $_POST["matricula"],
    "nombre"=> $_POST["nombre"],
    "carrera"=> $_POST["carrera"],
];
try{
    # preparando la cosnaulta
    $sentencia = $conex->prepare("update alumnos set matricula=:matricula, nombre=:nombre, carrera=:carrera where id=:id;");
    $resultado = $sentencia->execute($alumno);
    http_response_code(200);
    echo "datos actualizados";

}catch(PDOException $exc){
    http_response_code(400);
    echo "Lo siento, ocurrió un error:".$exc->getMessage();
}

?>