<?php require('views/header/header_administrador.php'); ?> 
<h1><?php if($accion == "crear"):echo('Nuevo');else :echo('Modificar');endif; ?> Empleado</h1>
<?php ?> 
<form method="post" action="empleado.php?accion=<?php if($accion == "crear"):echo('nuevo');else:
    echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input class="form-control" type="text" name="data[nombre]" placeholder="Escribe aqui el nombre" 
        id="id_empleado" value="<?php
        if(isset($empleados['nombre'])):echo($empleados['nombre']);endif; ?>" />
    </div>

    <div class="mb-3">
        <label for="primer_apellido" class="form-label">Primer apellido</label>
        <input class="form-control" type="text" name="data[primer_apellido]" placeholder="Escribe aqui la sección" 
        id="empleado" value="<?php
        if(isset($empleados['primer_apellido'])):echo($empleados['primer_apellido']);endif; ?>" /> 
    </div>

    <div class="mb-3">
        <label for="segundo_apellido" class="form-label">Segundo apellido</label>
        <input class="form-control" type="text" name="data[segundo_apellido]" placeholder="Escribe aqui el area en m2" 
        id="area" value="<?php
        if(isset($empleados['segundo_apellido'])):echo($empleados['segundo_apellido']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label class="form-label" for="rfc">RFC</label>
        <input class="form-control" type="text" name="data[rfc]" placeholder="Escribe el id del invernadero" 
        id="id_invernadero" value="<?php
        if(isset($empleados['rfc'])):echo($empleados['rfc']);endif; ?>"/>
    </div>
    
    <div class="mb-3">
        <label for="">Usuario</label>
        <select class="form-select" name="data[id_usuario]" id="">
            <?php foreach($usuarios as $usuario): ?>
            <?php 
                $selected = "";
                if($empleados['id_usuario'] == $usuario['id_usuario']){
                    $selected = "selected";
                }
            ?>
            <option value="<?php echo($usuario['id_usuario']);?>" <?php echo($selected); ?> ><?php echo($usuario['correo']); ?></option>
            <?php endforeach; ?>
            
        </select>
    </div>

    <div class="mb-3">
        <input class="btn btn-success" type="submit" name="data[enviar]" value="Guardar"/>
    </div>
</form>
<?php require('views/footer.php') ?> 