<?php
include 'vars.php';

if (file_exists($nombre_fichero)) {
    $conex = new PDO("sqlite:" . $nombre_fichero);
    $conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        $stmt = $conex->prepare('SELECT * FROM alumnos;');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //cerrar la bd
        $stmt=null;
        $conex=null;
        http_response_code(200);
        echo json_encode($data);
    }catch(PDOException $exc){
        http_response_code(400);
        echo "Error al abrir la base de datos----->".$exc->getMessage();
    }
}else{
    http_response_code(400);
    echo "No existe la base de datos";
}


?>