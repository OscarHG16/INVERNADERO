<?php
header("Content-type: application/json; charset=utf-8");
include("permisos.class.php");
$app = new permisos();
$app->checkRol("Administrador");
$action = $_SERVER['REQUEST_METHOD'];
$id = (isset($_GET['id']))?$_GET['id']:null;
$permisos;
$data = [];
switch($action){
    case "POST":
        $datos = $_POST;
        if(!is_null($id) && is_numeric($id)){
            $result = $app->update($id, $datos);
        }else{
            $result = $app->create($datos); 
        }

        if($result == 1){
            $data['mensaje'] = "El permiso se creo correctamente.";
        }else{
            $data['mensaje'] = "El permiso no se creo correctamente.";
        }
        break;

    case "DELETE":
        if(!is_null($id) && is_numeric($id)){
            $result =$app-> delete($id);
        }
        if($result){
            $message = "La permiso se borró correctamente.";
        }else{
            $message = "La permiso no se borró correctamente.";
        }
        $data['mensaje'] = $message;
        break;    
    default:
        if(!is_null($id) && is_numeric($id)){
            $permisos = $app->readOne($id); //uds -> readOne
        }else{
            $permisos = $app->readAll();//uds -> readAll
        }
        $data = $permisos;
}

echo json_encode($data);
?>