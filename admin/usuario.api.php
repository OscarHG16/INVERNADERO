<?php
header("Content-type: application/json; charset=utf-8");
require_once('usuario.class.php');
require_once('roles.class.php');

$app = new Usuario();
$appRoles = new Roles();
$action = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? $_GET['id'] : null;
$data = [];

switch ($action) {
    case "POST":
        $datos = $_POST;
        if (!is_null($id) && is_numeric($id)) {
            $result = $app->update($id, $datos);
            $data['mensaje'] = $result ? "Usuario actualizado correctamente." : "Error al crear el usuario.";
        } else {
            $result = $app->create($datos);
            $data['mensaje'] = $result ? "Usuario creado correctamente." : "Error al crear el usuario.";
        }
        break;

    case "DELETE":
        if (!is_null($id) && is_numeric($id)) {
            $result = $app->delete($id);
            $data['mensaje'] = $result ? "Usuario eliminado correctamente." : "Error al eliminar el usuario.";
        } else {
            $data['mensaje'] = "ID no válido.";
        }
        break;

    case "GET":
        if (!is_null($id) && is_numeric($id)) {
            $data = $app->readOne($id);
        } else {
            $data = $app->readAll();
        }
        break;

    default:
        http_response_code(405); 
        $data['mensaje'] = "Método no soportado.";
}

echo json_encode($data);
