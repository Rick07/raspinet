<div id="dispositivoTabla" style="width: 700px;"></div>
<!-- Button trigger modal -->
<button class="btn btn-primary btn-info" data-toggle="modal" data-target="#nuevaInst">Nuevo Dispositivo</button>

<!-- Modal -->
<div class="modal fade" id="nuevaInst" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Registro de nuevo dispositivo</h4>
      </div>
      <div class="modal-body">
        <?php echo validation_errors(); 
         $atr = array('id' => 'nuevoDispositivo', 'autocomplete' => 'off'); 
        echo form_open('raspberry/nuevoDispositivo', $atr); ?>
          <div class="form-group">
            <label for="mac">Dirección Mac</label>
            <input type="text" id="mac" name="mac" placeholder="Ingrese la dirección mac del dispositivo" title="La direccion mac debe tener un formato como el siguiente:  38:60:77:59:EB:EC" pattern="^([0-9a-fA-F][0-9a-fA-F]:){5}([0-9a-fA-F][0-9a-fA-F])$" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="">Seleccione el estado en el que se encuentra el dispositivo:</option>
                <?php foreach ($state as $datos): ?>
                <option value="<?php echo $datos['sCode'] ?>"><?php echo $datos['sName']?></option> 
                <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" placeholder="Ingrese la ubicación del dispositivo" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-primary" value="Guardar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

 <script type="text/javascript">
    $(document).ready(function () {
      var base_url = "<?=base_url()?>"; 
        $('#dispositivoTabla').jtable({
            title: 'Dispositivos',
            messages: {
            noDataAvailable: 'No hay informacion disponible',
            areYouSure: '¿Estas seguro?',
            editRecord: 'Editar registro',
            deleteConfirmation: 'Los datos asociados a este dispositivo se perderan. ¿Está seguro?',
            save: 'Guardar',
            saving: 'Guardando',
            cancel: 'Cancelar',
            deleteText: 'Borrar',
            deleting: 'Borrando',
            error: 'Error',
            close: 'Cerrar',
            pagingInfo: 'Mostrando {0}-{1} de {2} registros',
            pageSizeChangeLabel: 'Numero de filas en la tabla',
            gotoPageLabel: 'Ir a la pagina:',
            canNotDeletedRecords: 'No se pueden borrar {0} de {1} registros',
            deleteProggress: 'Borrados {0} de {1} registros, procesando...'
            },
            actions: {
                listAction: base_url+'index.php/raspberry/listarDispositivo',
                updateAction: base_url+'index.php/raspberry/actualizarDispositivo',
                deleteAction: base_url+'index.php/raspberry/borrarDispositivo'
            },
            fields: {
                mac: {
                    title: 'Dispositivo',
                    key: true,
                    width: '10%'
                },
                estado: {
                    title: 'Estado',
                    width: '30%',
                    options: base_url+'index.php/state/listarEstados'
                },
                ubicacion: {
                    title: 'Ubicación',
                    width: '20%'
                }
            }
        });
          $('#dispositivoTabla').jtable('load');
    });
</script>
<script language="javascript">
$(document).ready(function() {
   // Interceptamos el evento submit
    $('#nuevoDispositivo').submit(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                alert("DATOS REGISTRADOS");
                $("#nuevoDispositivo")[0].reset();
                $('#dispositivoTabla').jtable('reload');
            }
        })        
        return false;
    }); 
})  
</script>