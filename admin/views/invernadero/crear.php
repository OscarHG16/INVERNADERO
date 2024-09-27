<?php require('views/header.php') ?> 
<h1><?php if($accion == "crear"):echo('Nuevo');else :echo('Modificar');endif; ?> invernadero</h1> 
<form method="post" action="invernadero.php?accion=<?php if($accion == "crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="invernadero" class="form-label">Nombre del invernadero</label>
        <input class="form-control" type="text" name="data[invernadero]" placeholder="Escribe aqui el nombre" id="invernadero" value="<?php
        if(isset($invernaderos['invernadero'])):echo($invernaderos['invernadero']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="latitud" class="form-label">Latitud del invernadero</label>
        <input class="form-control" type="text" name="data[latitud]" placeholder="Escribe aqui la Latitud" id="latitud" value="<?php
        if(isset($invernaderos['latitud'])):echo($invernaderos['latitud']);endif; ?>" /> 
    </div>
    <div class="mb-3">
        <label for="longitud" class="form-label">Longitud del invernadero</label>
        <input class="form-control" type="text" name="data[longitud]" placeholder="Escribe aqui la Longitud" id="longitud" value="<?php
        if(isset($invernaderos['longitud'])):echo($invernaderos['longitud']);endif; ?>"/>
    </div>
    <div class="mb-3">
        <label for="area" class="form-label">Area del invernadero (m <sup>2<sup/>)</label>
        <input class="form-control" type="number" name="data[area]" placeholder="Escribe aqui el area en m2" id="area" value="<?php
        if(isset($invernaderos['area'])):echo($invernaderos['area']);endif; ?>"/>
    </div>
    <div class="mb-3">
        <label class="form-label" for="fecha">Fecha</label>
        <input class="form-control" type="date" name="data[fecha_creacion]" placeholder="Escribe aqui la fecha" id="fecha" value="<?php
        if(isset($invernaderos['fecha_creacion'])):echo($invernaderos['fecha_creacion']);endif; ?>"/>
    </div>
    <div class="mb-3">
        <input class="btn btn-success" type="submit" name="data[enviar]" value="Guardar"/>
    </div>
</form>
<?php require('views/footer.php') ?> 