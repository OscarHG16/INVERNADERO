<?php 
require_once ('seccion.class.php');
require_once ('invernadero.class.php');
$appInvernadero = new invernadero();
$app = new seccion();
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion']))?$_GET['accion']:null;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch($accion){
    case 'crear':
        $invernaderos = $appInvernadero ->readAll();
        require_once 'views/seccion/crear.php'; 
        break;

    case 'nuevo':
        $data=$_POST['data'];
        $resultado=$app->create($data);
        if($resultado){
            $mensaje="Sección agregada correctamente";
            $tipo="success";
        }
        else{
            $mensaje="Ocurrio un error";
            $tipo="danger";
        }
        $secciones = $app->readALL();
        require_once('views/seccion/index.php');
        break;

    case 'actualizar':
        $secciones = $app->readOne($id);
        $invernaderos = $appInvernadero -> readAll();
        require_once('views/seccion/crear.php');
        break;
    
    case 'modificar':
        $data = $_POST['data'];
        $resultado =$app->update($id, $data);
        if($resultado){
            $mensaje="La sección se actualizo correctamente";
            $tipo="success";
        }
        else{
            $mensaje="La sección no se actualizo";
            $tipo="danger";
        }
        $secciones = $app->readALL();
        require_once('views/seccion/index.php');
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
        $secciones = $app->readALL();
        require_once ('views/seccion/index.php');
        break;
        case 'reporte':
            if (!is_null($id)) {
                if (is_numeric($id)) {
                    $resultado = $app->reporte($id);
                    if ($resultado) {
                        $mensaje = "Reporte exitoso";
                        $tipo = "success";
                    } else {
                        $mensaje = "Ocurrio un error al generar un reporte.";
                        $tipo = "danger";
                    }
                }
            }
            $secciones = $app->readAll();
            include('views/seccion/index.php');
            break;

    default:
        $secciones = $app->readALL();
        require_once 'views/seccion/index.php';
}
require_once("views/footer.php");
?>