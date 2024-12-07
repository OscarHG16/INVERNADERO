<?php
require_once ('../sistema.class.php');

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


class empleado extends sistema {
    function create ($data) {
        $result = [];
        $this->conexion();
        $sql="INSERT INTO empleado(primer_apellido,segundo_apellido,nombre,rfc,fotografia, id_usuario) 
        VALUES(:primer_apellido,:segundo_apellido,:nombre,:rfc,:fotografia, :id_usuario);";
        $modificar=$this->con->prepare($sql);
        $fotografia = $this->uploadFoto();
        $modificar->bindParam(':primer_apellido',$data['primer_apellido'],PDO::PARAM_STR);
        $modificar->bindParam(':segundo_apellido',$data['segundo_apellido'],PDO::PARAM_STR);
        $modificar->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
        $modificar->bindParam(':rfc',$data['rfc'],PDO::PARAM_INT);
        $modificar->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
        $modificar->bindParam(':fotografia',$fotografia,PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    public function update($id, $data) {
        $this->conexion();
        $tmp = "";
        if($_FILES['fotografia']['error'] != 4){
            $fotografia = $this->uploadFoto();
            $tmp="fotografia=:fotografia";
        }
        $sql = "UPDATE empleado SET nombre = :nombre, primer_apellido = :primer_apellido,
                segundo_apellido = :segundo_apellido, rfc = :rfc, $tmp
                WHERE id_empleado = :id_empleado";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        if($_FILES['fotografia']['error'] != 4){
            $modificar->bindParam(':fotografia', $fotografia, PDO::PARAM_STR);
        }
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

    function uploadFoto(){
        $tipos = array("image/jpeg","image/png","image/gif");
        $data = $_FILES['fotografia'];
        $default = "default.png"; 
        if($data['error']==0){
            if($data['size'] <= 1048576){
                if(in_array($data['type'],$tipos)){
                    $n = rand(1,1000000);
                    $nombre = explode('.',$data['name']);
                    $imagen = md5($n.$nombre[0]).".".$nombre[sizeof($nombre)-1];
                    $origen = $data['tmp_name'];
                    $destino = "C:\\xampp\\htdocs\\crops\\uploads\\".$imagen;
                    if(move_uploaded_file($origen, $destino)){
                        return $imagen;
                    }
                    return $default;
                }
            }
        }
        return $default;
    }

    function reporte($id) {
        require_once('../vendor/autoload.php');
        $this->conexion();
        $sql = 'SELECT * FROM empleado WHERE id_empleado=:id_empleado';
        $reporte = $this->con->prepare($sql);
        $reporte->bindParam(":id_empleado", $id, PDO::PARAM_INT);
        $reporte->execute();
        $data = $reporte->fetchAll(PDO::FETCH_ASSOC);


        
    
        try {
            include('../lib/phpqrcode/qrlib.php');
            
            $file_name = '../qr/'.$id.'.png';
            QRcode::png('http://localhost/crops4/admin/empleado.php?accion=actualizar&id=' .$id, $file_name, 2, 10, 3);
            ob_start();
            $content = ob_get_clean();
            $content = '
            <html>
                <body>
                    <table>
                        <tr>
                            <td>
                                <img src="../images/logotipo_invernadero.png" width="150">
                            </td>
                            <td>
                                <h1>Empleados</h1>
                            </td>
                        </tr>
                    </table>
                    <table border="1">
                        <tr>
                            <th>Id Empleado</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>Nombre</th>
                            <th>Id Usuario</th>
                             <th>Fotografia</th>
                        </tr>';
            
            foreach ($data as $seccion) {
                $fotoPath = "../uploads/" . $seccion['fotografia'];
                $content .= '<tr>';
                $content .= '<td>' . $seccion['id_empleado'] . '</td>';
                $content .= '<td>' . $seccion['primer_apellido'] . '</td>';
                $content .= '<td>' . $seccion['segundo_apellido'] . '</td>';
                $content .= '<td>' . $seccion['nombre'] . '</td>';
                $content .= '<td>' . $seccion['id_usuario'] . '</td>';
                $content .= '<td><img src="' . $fotoPath . '" width="150" alt="Fotografía del empleado"></td>';
                $content .= '</tr>';
            }
    
            $content .= '
                    </table>
                    <div>
                        <h1>Tenemos ' . sizeof($data) . ' secciones</h1>
                    </div>
                    <img src="../qr/'.$id.'.png" width="150">
                </body>
            </html>
            ';
    
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            $html2pdf->output('ejemplo.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
    
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }
}
?>
