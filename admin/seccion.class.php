<?php
require_once('../sistema.class.php');

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class seccion extends sistema
{
    function create($data)
    {
        $result = [];
        $this->conexion();
        $sql = "INSERT INTO seccion (seccion, area, id_invernadero) 
    VALUES(:area,:seccion,:id_invernadero);";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':area', $data['area'], PDO::PARAM_INT);
        $insertar->bindParam(':seccion', $data['seccion'], PDO::PARAM_STR);
        $insertar->bindParam(':id_invernadero', $data['id_invernadero'], PDO::PARAM_INT);
        $insertar->execute();
        $result = $insertar->rowCount();
        //print($result);
        return $result;

        /*print_r($data);
    die();*/
    }

    function update($id, $data)
    {
        $result = [];
        $this->conexion();
        $sql = "UPDATE seccion set seccion=:seccion, area=:area, id_invernadero=:id_invernadero where
        id_seccion=:id_seccion;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_seccion', $id, PDO::PARAM_INT);
        $modificar->bindParam(':area', $data['area'], PDO::PARAM_INT);
        $modificar->bindParam(':id_invernadero', $data['id_invernadero'], PDO::PARAM_INT);
        $modificar->bindParam(':seccion', $data['seccion'], PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    function delete($id)
    {
        $result = [];
        $this->conexion();
        if (is_numeric($id)) {
            $sql = "delete from seccion where id_seccion=:id_seccion";
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam(':id_seccion', $id, PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();
            return $result;
        }
    }

    function readOne($id)
    {
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM seccion where id_seccion=:id_seccion;';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(":id_seccion", $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll()
    {
        $this->conexion();
        $result = [];
        $consulta = 'SELECT s.*, i.invernadero FROM seccion s join invernadero i on s.id_invernadero=i.id_invernadero';
        $sql = $this->con->prepare($consulta);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function reporte()
    {
        require_once('../vendor/autoload.php');
        $this->conexion();
        $sql = 'SELECT * FROM vw_secciones';
        $consulta = $this->con->prepare($sql);
        $consulta->execute();
        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);

        try {
            include('../libs/phpqrcode/qrlib.php');
            $id_factura = rand(1, 1000);
            $file_name = '../qr/' . $id_factura . '.png';
            QRcode::png('http://localhost/crops/facturas/' . $id_factura, $file_name, 2, 10, 3);
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
                                <h1>Secciones e Invernaderos</h1>
                            </td>
                        </tr>
                    </table>
                    <table border="1">
                        <tr>
                            <th>Sección</th>
                            <th>Número de invernaderos</th>
                        </tr>';

            foreach ($data as $seccion) {
                $content .= '<tr>';
                $content .= '<td>' . $seccion['seccion'] . '</td>';
                $content .= '<td>' . $seccion['count(i.id_invernadero)'] . '</td>';
                $content .= '</tr>';
            }

            $content .= '
                    </table>
                    <div>
                        <h1>Tenemos ' . sizeof($data) . ' secciones</h1>
                    </div>
                    <img src="../qr/' . $id_factura . '.png" width="150">
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
