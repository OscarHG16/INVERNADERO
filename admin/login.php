<?php
    require_once('../sistema.class.php');
    

    $app=new Sistema;    
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    
    switch($accion){
        case 'login':
            $correo=$_POST['data']['correo'];
            
            $contrasena=$_POST['data']['contrasena'];
           if($app->login($correo,$contrasena)){
                $mensaje="Bienvenido al sistema";
                $tipo="success";
                $app->checkRol('Administrador');
                require_once('views/header/header_administrador.php');
                $app->alerta($tipo,$mensaje);
                //plantillas personalizas de bienvenida
                
                
           }else{
                $mensaje="Correo o contraseña equivocado 
                    <a href='login.php'> [Presione aqui para volver intentar]</a>";
                $tipo="danger";
                require_once('views/header.php');
                $app->alerta($tipo,$mensaje);
           }
           break;
        case 'logout':
            $app->logout();
            break;
        default:
            require_once('views/login/index.php');
            break;
    }
    require_once('views/footer.php');
?>