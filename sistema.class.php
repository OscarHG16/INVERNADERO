<?php

require_once('config.class.php');

class Sistema{
    var $con;
    function conexion(){
        $this -> con = new PDO(SGBD.':host='.DBHOST.';dbname='.DBNAME.';port='.DBPORT, DBUSER, DBPASS);
    }

    function alerta($tipo, $mensaje){
        require_once ('views/alert.php');
    }

    function getRol($correo){
        $this -> conexion();
        $data=[];
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $sql= " select r.rol from usuario u 
                    inner join usuario_rol ur on u.id_usuario=ur.id_usuario
                    inner join rol r on r.id_rol=ur.id_rol
                    where u.correo=:correo;";
            $roles = $this->con->prepare($sql);
            $roles->bindParam(':correo',$correo,PDO::PARAM_STR);
            $roles->execute();
            $data = $roles->fetch(PDO::FETCH_ASSOC);
        }
        return $data;

    }
    function getPrivilegios($correo){
        $this -> conexion();
        $data=[];
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $sql= " select r.rol from usuario u 
                    inner join usuario_rol ur on u.id_usuario=ur.id_usuario
                    inner join rol r on r.id_rol=ur.id_rol
                    inner join rol_permiso rp on rp.id_rol=r.id_rol
                    inner join permiso p on p.id_permiso=rp.id_permiso
                    where u.correo=:correo;";
            $privilegios = $this->con->prepare($sql);
            $privilegios->bindParam(':correo',$correo,PDO::PARAM_STR);
            $privilegios->execute();
            $data = $privilegios->fetch(PDO::FETCH_ASSOC);
        }
        return $data;
    }
}

?>