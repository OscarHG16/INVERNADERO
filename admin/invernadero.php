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
switch($accion){
    case 'crear':
        include 'views/invernadero/crear.php'; //Al precionar el btn de crear se redirige a la clase crear.php y su contenido
        break;
    case 'nuevo';
        $data=$_POST['data'];
        $app->create($data);
        /*print_r($_GET);
        print_r($_POST);*/
        break;
    case 'actualizar';
        break;
    case 'eliminar';
        break;
    default:
        $invernaderos = $app->readALL();
        include ('views/invernadero/index.php');
}

?>