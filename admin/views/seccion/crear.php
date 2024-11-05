<?php require('views/header/header_administrador.php'); ?> 
<h1><?php if($accion == "crear"):echo('Nuevo');else :echo('Modificar');endif; ?> seccion</h1>
<?php ?> 
<form method="post" action="seccion.php?accion=<?php if($accion == "crear"):echo('nuevo');else:
    echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="id_seccion" class="form-label">Nombre del seccion</label>
        <input class="form-control" type="text" name="data[id_seccion]" placeholder="Escribe aqui el nombre" 
        id="id_seccion" value="<?php
        if(isset($secciones['id_seccion'])):echo($secciones['id_seccion']);endif; ?>" />
    </div>

    <div class="mb-3">
        <label for="seccion" class="form-label">Seccion</label>
        <input class="form-control" type="number" name="data[seccion]" placeholder="Escribe aqui la sección" 
        id="seccion" value="<?php
        if(isset($secciones['seccion'])):echo($secciones['seccion']);endif; ?>" /> 
    </div>

    <div class="mb-3">
        <label for="area" class="form-label">Area del seccion (m <sup>2<sup/>)</label>
        <input class="form-control" type="number" name="data[area]" placeholder="Escribe aqui el area en m2" 
        id="area" value="<?php
        if(isset($secciones['area'])):echo($secciones['area']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label class="form-label" for="id_invernadero">Id Sección</label>
        <input class="form-control" type="number" name="data[id_invernadero]" placeholder="Escribe el id del invernadero" 
        id="id_invernadero" value="<?php
        if(isset($secciones['id_invernadero'])):echo($secciones['id_invernadero']);endif; ?>"/>
    </div>
    
    <div class="mb-3">
        <label for="">Invernadero</label>
        <select class="form-select" name="data[id_invernadero]" id="">
            <?php foreach($invernaderos as $invernadero): ?>
            <?php 
                $selected = "";
                if($secciones['id_invernadero'] == $invernadero['id_invernadero']){
                    $selected = "selected";
                }
            ?>
            <option value="<?php echo($invernadero['id_invernadero']);?>" <?php echo($selected); ?> ><?php echo($invernadero['invernadero']); ?></option>
            <?php endforeach; ?>
            
        </select>
    </div>

    <div class="mb-3">
        <input class="btn btn-success" type="submit" name="data[enviar]" value="Guardar"/>
    </div>
</form>
<?php require('views/footer.php') ?> 