<?php
require_once ('empleado.class.php');
$app = new Empleado;
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion']))?$_GET['accion']:null;
$id=(isset($_GET['id']))?$_GET['id']:null;
switch($accion){
    case 'crear':
        include 'views/empleado/crear.php';
        break;
    case 'nuevo':
        $data=$_POST['data'];
        $resultado= $app->create($data);
        if($resultado){
            $mensaje="El empleado se agrego correctamente";
            $tipo="success";
        }else{
            $mensaje="Ocurrio un error al agregar el empleado";
            $tipo="danger";
        }
        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    case 'actualizar':
        $empleados=$app->readOne($id);
        include('views/empleado/crear.php');
        break;

    case 'modificar':
        $data= $_POST['data'];
        $resultado = $app->update($id,$data);
        if($resultado){
            $mensaje="El empleado se modificó correctamente";
            $tipo="success";
        } else {
            $mensaje="Ocurrió un error al modificar el empleado";
            $tipo="danger";
        }
        $empleados = $app->readAll();
        include('views/empleado/index.php');
        break;
    case 'eliminar':
        if(!is_null($id)){
            if(is_numeric($id)){
                $resultado=$app->delete($id);
                if($resultado){
                    $mensaje="Se elimino exitosamente el empleado";
                    $tipo="success";
                }else{
                    $mensaje="Hubo un problema con la eliminacion";
                    $tipo="danger";
                }
            }
        }
        $empleados = $app->readAll();
        include 'views/empleado/index.php';
        break;
    default:
        $empleados = $app->readAll();
        include 'views/empleado/index.php';
}
require_once('views/footer.php')
?>