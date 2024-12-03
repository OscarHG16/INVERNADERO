<?php require('views/header/header_administrador.php'); ?>
<h1>Empleados</h1>
<?php if(isset($mensaje)):$app->alerta($tipo, $mensaje);endif; ?>
<a href="empleado.php?accion=crear" class="btn btn-success">Nuevo</a>
<table class="table">

    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Fotografia</th>
        <th scope="col">Primer apellido</th>
        <th scope="col">Segundo apellido</th>
        <th scope="col">Nombre</th>
        <th scope="col">RFC</th>
        <th scope="col">Id usuario</th>
        <th scope="col">Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($empleados as $empleado):?>
    <tr>
        <th scope="row"><?php echo $empleado['id_empleado']; ?></th>
        <td> <img src="<?php
            if (file_exists("../uploads/".$empleado['fotografia'])) {
                echo("../uploads/".$empleado['fotografia']);
            }else {
                echo("../uploads/default.jpg");
            }
        ?>" class="rounded-circle" width = "100px" height = "100px"></td>
        <td ><?php echo $empleado['primer_apellido'];?></td>
        <td><?php echo $empleado['segundo_apellido']; ?></td>
        <td><?php echo $empleado['nombre']; ?> </td>
        <td><?php echo $empleado['rfc'];?></td>
        <td><?php echo $empleado['id_usuario']; ?></td>

        <td>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <a href="empleado.php?accion=actualizar&id=<?php echo $empleado['id_empleado']; ?>" class="btn btn-warning">Actualizar</a>
                <a href="empleado.php?accion=eliminar&id=<?php echo $empleado['id_empleado']; ?>" class="btn btn-danger">Eliminar</a>
                <a href="empleado.php?accion=reporte&id=<?php echo $empleado['id_empleado']; ?>" class="btn btn-primary">Reporte</a>
            </div>
        </td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>

<?php require('views/footer.php'); ?>