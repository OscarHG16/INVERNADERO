<?php
require_once ('../sistema.class.php');

class empleado extends sistema {
    function create ($data) {
        $result = [];
        $this->conexion();
        $sql="INSERT INTO empleado(primer_apellido,segundo_apellido,nombre,rfc) 
        VALUES(:primer_apellido,:segundo_apellido,:nombre,:rfc);";
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':primer_apellido',$data['primer_apellido'],PDO::PARAM_STR);
        $modificar->bindParam(':segundo_apellido',$data['segundo_apellido'],PDO::PARAM_STR);
        $modificar->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
        $modificar->bindParam(':rfc',$data['rfc'],PDO::PARAM_INT);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    public function update($id, $data) {
        $this->conexion();
        $sql = "UPDATE empleado SET nombre = :nombre, primer_apellido = :primer_apellido,
                segundo_apellido = :segundo_apellido, rfc = :rfc 
                WHERE id_empleado = :id_empleado";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $modificar->bindParam(':rfc', $data['rfc'], PDO::PARAM_INT);
        $modificar->bindParam(':id_empleado', $id, PDO::PARAM_INT);
        return $modificar->execute();
    }    

    function delete ($id) {
        $result = [];
        $this->conexion();
        $sql="delete from empleado where id_empleado=:id_empleado";
        $borrar=$this->con->prepare($sql);
        $borrar->bindParam(':id_empleado',$id,PDO::PARAM_INT);
        $borrar->execute();
        $result = $borrar->rowCount();
        return $result;
    }

    function readOne($id) {
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM empleado WHERE id_empleado = :id_empleado';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(':id_empleado', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }    

    function readAll(){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM empleado';
        $sql = $this->con->prepare($consulta);
        $sql -> execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}
?>