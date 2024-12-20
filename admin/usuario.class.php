<?php
require_once('../sistema.class.php');
class Usuario extends Sistema {
    function create($data) {
        $this->conexion();
        $rol = $data['rol'];
        $data =$data['data'];
        $this->con->beginTransaction();
        try {
            $sql = "INSERT INTO usuario (correo, contrasena) VALUES (:correo, :contrasena)";
            $insertar = $this->con->prepare($sql);
            $data['contrasena'] = md5($data['contrasena']); 
            $insertar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $insertar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
            $insertar->execute();
            $sql = "SELECT id_usuario from usuario where correo = :correo";
            $consulta = $this->con->prepare($sql);
            $consulta->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $consulta->execute();
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            $id_usuario = isset($datos['id_usuario'])? $datos['id_usuario']: null;
            if(!is_null($id_usuario)){
                foreach($rol as $r => $k){
                    $sql = "INSERT INTO usuario_rol(id_usuario,id_rol)
                    VALUES(:id_usuario,:id_rol)";
                    $insertar_rol = $this->con->prepare($sql);
                    $insertar_rol->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $insertar_rol->bindParam(':id_rol', $r, PDO::PARAM_INT);
                    $insertar_rol->execute();
                }
                $this->con->commit();
                $this->sendMail($data['correo'],'Bienvenido a CROPS!', 'Bienvenido al sistema');
                return $insertar->rowCount(); 
            }
        } catch (Exception $e) {
            $this->con->rollback();
        } 
        return false;
    }
    function update($id, $data) {
        $this->conexion();
        $rol=$data['rol'];
        $data=$data['data'];
        $this->con->beginTRansaction();
        try{
            $sql = "UPDATE usuario SET correo = :correo, contrasena = :contrasena WHERE id_usuario = :id_usuario";
            $modificar = $this->con->prepare($sql);
            $data['contrasena'] = md5($data['contrasena']);
            $modificar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $modificar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $modificar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
            $modificar->execute();
            $sql="DELETE from usuario_rol where id_usuario = :id_usuario";
            $this->con->commit();
            return $modificar->rowCount();
        }catch(Exception $e){
            $this->con->rollBack();
        }
        return false;
    }
    function delete($id){
        $this->conexion();
        $this->con->beginTransaction();
        try {
            $sql = "DELETE FROM usuario_rol WHERE id_usuario = :id_usuario";
            $borrarRoles = $this->con->prepare($sql);
            $borrarRoles->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $borrarRoles->execute();
            $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
            $borrarUsuario = $this->con->prepare($sql);
            $borrarUsuario->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $borrarUsuario->execute();
            $this->con->commit();
            return $borrarUsuario->rowCount();
        } catch (Exception $e) {
            $this->con->rollBack();
        }
    }
    
    function readOne($id) {
        $this->conexion();
        $sql="SELECT * FROM usuario WHERE id_usuario = :id_usuario";
        $consulta = $this->con->prepare($sql);
        $consulta->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    function readAll() {
        $this->conexion();
        $sql="SELECT * FROM usuario";
        $consulta = $this->con->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    function readAllRoles($id){
        $this->conexion();
        $sql = "SELECT distinct r.id_rol from usuario u 
        join usuario_rol ur on u.id_usuario = ur.id_usuario 
        join rol r on ur.id_rol = r.id_rol WHERE u.id_usuario=:id_usuario;";
        $consulta = $this->con->prepare($sql); 
        $consulta->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $consulta->execute();
        $roles=array();
        $roles=$consulta->fetchAll(PDO::FETCH_ASSOC);
        $data=[];
        foreach($roles as $rol){
            array_push($data,$rol['id_rol']);
        }
        return $data;
    }
}
?>