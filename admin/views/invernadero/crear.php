<?php require('views/header.php') ?> 
<h1>Nuevo invernadero</h1> <!Tapa de arriba del sandwich
<form method="post" action="invernadero.php?accion=nuevo">
    <!Todos estos estan asociados a las columnas de nuestra base de datos
    <div class="mb-3">
        <label for="invernadero" class="form-label">Nombre del invernadero</label>
        <input class="form-control" type="text" name="data[invernadero]" placeholder="Escribe aqui el nombre" id="invernadero" />
    </div>
    <div class="mb-3">
        <label for="latitud" class="form-label">Latitud del invernadero</label>
        <input class="form-control" type="text" name="data[latitud]" placeholder="Escribe aqui la Latitud" id="latitud" /> 
    </div>
    <div class="mb-3">
        <label for="longitud" class="form-label">Longitud del invernadero</label>
        <input class="form-control" type="text" name="data[longitud]" placeholder="Escribe aqui la Longitud" id="longitud"/>
    </div>
    <div class="mb-3">
        <label for="area" class="form-label">Area del invernadero (m <sup>2<sup/>)</label>
        <input class="form-control" type="number" name="data[area]" placeholder="Escribe aqui el area en m2" id="area"/>
    </div>
    <div class="mb-3">
        <label class="form-label" for="fecha">Fecha</label>
        <input class="form-control" type="date" name="data[fecha_creacion]" placeholder="Escribe aqui la fecha" />
    </div>
    <div class="mb-3">
        <input class="btn btn-success" type="submit" nane="data[enviar]" value="Guardar"/>
    </div>
</form>
<?php require('views/footer.php') ?> <!Tapa de abajo del sandwich