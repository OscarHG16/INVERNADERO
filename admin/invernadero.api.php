<?php
header("Content-type: application/json; charset=utf-8");
require_once('invernadero.class.php');

$app = new Invernadero();
$accion = $_SERVER['REQUEST_METHOD'];
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$data = [];

try {
    switch ($accion) {
        case 'POST':
            // Crear o actualizar
            $datos = !empty($_POST) ? $_POST : json_decode(file_get_contents('php://input'), true);
            if (!is_null($id) && is_numeric($id)) {
                $resultado = $app->update($id, $datos);
                $data['message'] = $resultado ? 'Invernadero actualizado correctamente' : 'Error al actualizar el invernadero';
            } else {
                $resultado = $app->create($datos);
                $data['message'] = $resultado ? 'Invernadero creado correctamente' : 'Error al crear el invernadero';
            }
            $data['success'] = $resultado ? true : false;
            break;

        case 'GET':
            // Leer uno o todos
            if (!is_null($id) && is_numeric($id)) {
                $data['data'] = $app->readOne($id);
            } else {
                $data['data'] = $app->readAll();
            }
            $data['success'] = true;
            break;

        case 'DELETE':
            // Eliminar
            if (!is_null($id) && is_numeric($id)) {
                $resultado = $app->delete($id);
                $data['message'] = $resultado ? 'Invernadero eliminado correctamente' : 'Error al eliminar el invernadero';
                $data['success'] = $resultado ? true : false;
            } else {
                http_response_code(400);
                $data['message'] = 'ID inválido para eliminar';
            }
            break;
            
        default:
            http_response_code(405);
            $data['message'] = 'Método HTTP no permitido';
    }
} catch (Exception $e) {
    http_response_code(500);
    $data = [
        'success' => false,
        'message' => 'Error interno del servidor',
        'error' => $e->getMessage()
    ];
}

echo json_encode($data);
?>