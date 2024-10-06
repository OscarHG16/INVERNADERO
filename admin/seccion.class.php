<?php 
require_once ('../sistema.class.php');

class seccion extends sistema{
    function create($data){
    $result=[];
    $this->conexion();
    $sql="INSERT INTO seccion (seccion, area, id_invernadero) 
    VALUES(:area,:seccion,:id_invernadero);";
    $insertar=$this->con->prepare($sql);
    $insertar->bindParam(':area',$data['area'],PDO::PARAM_INT);
    $insertar->bindParam(':seccion',$data['seccion'],PDO::PARAM_STR);
    $insertar->bindParam(':id_invernadero',$data['id_invernadero'],PDO::PARAM_INT);
    $insertar->execute();
    $result=$insertar->rowCount();
    //print($result);
    return $result;
    
    /*print_r($data);
    die();*/
    }

    function update($id,$data){
        $result = [];
        $this->conexion();
        $sql = "UPDATE seccion set seccion=:seccion, area=:area, id_invernadero=:id_invernadero where
        id_seccion=:id_seccion;";
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':id_seccion',$id,PDO::PARAM_INT);
        $modificar->bindParam(':area',$data['area'],PDO::PARAM_INT);
        $modificar->bindParam(':id_invernadero',$data['id_invernadero'],PDO::PARAM_INT);
        $modificar->bindParam(':seccion',$data['seccion'],PDO::PARAM_STR);
        $modificar->execute();
        $result=$modificar->rowCount();    
        return $result;
    }

    function delete($id){
        $result = [];
        $this->conexion();
        if(is_numeric($id)){
        $sql= "delete from seccion where id_seccion=:id_seccion";
        $borrar=$this->con->prepare($sql);
        $borrar->bindParam(':id_seccion',$id,PDO::PARAM_INT);
        $borrar->execute();
        $result=$borrar->rowCount();
        return $result;
        }
        
    }

    function readOne($id){
        $this -> conexion();
        $result = [];
        $consulta = 'SELECT * FROM seccion where id_seccion=:id_seccion;';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(":id_seccion", $id, PDO::PARAM_INT);
        $sql -> execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll(){
        $this -> conexion();
        $result = [];
        $consulta = 'SELECT s.*, i.invernadero FROM seccion s join invernadero i on s.id_invernadero=i.id_invernadero';
        $sql = $this->con->prepare($consulta);
        $sql -> execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>