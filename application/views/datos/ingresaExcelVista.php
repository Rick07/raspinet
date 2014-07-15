		<?php  echo br(3);?>
		<div class="col-md-3 col-md-offset-4">
		<?php  $attrib = array('id' => 'formDatEx', 'name' => 'formDatEx', 'class' => 'form-horizontal', 'role' => 'form'); ?>
        <?=form_open_multipart('datos/importarDatosExcel', $attrib)?>
        <div class="form-group">
        <label for="instalacion">Instalación</label>
            <select class="form-control" id="instalacion" required>
                <option value="">Seleccione una de sus instalaciones:</option>
                <?php foreach ($instalacion as $datos): ?>
                <option value="<?php echo $datos['idinstalacion'] ?>"><?php echo $datos['nombreinstalacion']?></option> 
                <?php endforeach ?>
            </select>
        </div>
        <div id="equi" class="form-group"></div>
        <div class="form-group">
        <input  type="file" name="file"  required>
        </div>
        <div class="form-group">
        <input type="submit" name="submit" id="Upload" value="Subir Archivo" class="btn btn-primary">
        </div>
        <?=form_close()?>
        </div>
<script type="text/javascript">
$(document).ready(function(){ 
   $("#instalacion").change(function(evento){
    var inst = $('#instalacion').val();
      evento.preventDefault();
      $("#equi").load("equipos/listarEquiposIdInstalacion", {instalacion: inst});
   });
});
</script>
        

