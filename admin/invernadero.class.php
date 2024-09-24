<?php 
include ('../sistema.class.php');

class invernadero extends sistema{
    function create($data){
    $result=[];
    print_r($data);
    die();
    return $result;
    }

    function update($id,$data){
        $result = [];
        return $result;
    }

    function delete($id){
        $result = [];
        return $result;
    }

    function readOne($id){
        $result = [];
        return $result;
    }

    function readAll(){
        $this -> conexion();
        $result = [];
        $consulta = 'SELECT * FROM invernadero';
        $sql = $this->con->prepare($consulta);
        $sql -> execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>