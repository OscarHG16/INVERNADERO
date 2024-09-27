<?php 
include ('invernadero.class.php');
$app = new Invernadero;

/*$app -> conexion();
print_r($app)
$resultado = $app->readALL();
print_r()*/

$accion = (isset($_GET['accion']))?$_GET['accion']:null;
/*
print_r($accion);
die();
*/
$id=(isset($_GET['id']))?$_GET['id']:null;
switch($accion){
    case 'crear':
        include 'views/invernadero/crear.php'; //Al precionar el btn de crear se redirige a la clase crear.php y su contenido
        break;

    case 'nuevo':
        $data=$_POST['data'];
        $resultado=$app->create($data);
        if($resultado){
            $mensaje="Invernadero agregado correctamente";
            $tipo="success";
        }
        else{
            $mensaje="Ocurrio un error";
            $tipo="danger";
        }
        $invernaderos = $app->readALL();
        include('views/invernadero/index.php');
        /*print_r($_GET);
        print_r($_POST);*/
        break;

    case 'actualizar':
        $invernaderos = $app->readOne($id);
        include('views/invernadero/crear.php');
        break;
    
    case 'modificar':
        $data = $_POST['data'];
        $resultado =$app->update($id, $data);
        if($resultado){
            $mensaje="Invernadero se actualizo correctamente";
            $tipo="success";
        }
        else{
            $mensaje="El invernadero no se actualizo";
            $tipo="danger";
        }
        $invernaderos = $app->readALL();
        include('views/invernadero/index.php');
        break;

    case 'eliminar':
        if(!is_null($id)){
            if(is_numeric($id)){
                $resultado=$app->delete($id);
                if($resultado){
                    $mensaje="El invernadero se elimino correctamente";
                    $tipo="success";
                }
                else{
                    $mensaje="Ocurrio un error";
                    $tipo="danger";
                }
            }
        }
        $invernaderos = $app->readALL();
        include ('views/invernadero/index.php');
        break;

    default:
        $invernaderos = $app->readALL(); //Cargamos elementos
        include 'views/invernadero/index.php';
}

?>