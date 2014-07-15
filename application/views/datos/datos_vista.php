<div class="filtering">
    <form>
        ID: <input type="text" name="dato" id="dato"  />
        <button type="submit" id="LoadRecordsButton">Buscar</button>
    </form>
</div>
<div id="datosTabla" style="width: 1200px;"></div>
<!-- Button trigger modal -->
<button id="nuevoreg" class="btn btn-primary btn-info" data-toggle="modal" data-target="#nuevo">Nuevo</button>
<?php date_default_timezone_set("America/Mexico_City"); ?> 
<!-- Modal -->
<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Registro de Datos</h4>
      </div>
      <div class="modal-body">
        <?php echo validation_errors(); 
         $atr = array('id' => 'nuevosDat', 'autocomplete' => 'off'); 
        echo form_open('datos/newData', $atr); ?>
        <!--<input type="hidden" name="fecha" value="<?php //echo date('Y-m-d');?>">-->
        <!--<input type="hidden" name="hora" value="<?php //echo date('H:i:s'); ?> ">-->
        <div class="form-group">
            <label for="hour">Fecha</label>
            <input id="hour" type="date"  name="fecha"  class="form-control" required>
            </div>
          <div class="form-group">
            <label for="time">Hora</label>
            <input id="time" type="time"  name="hora"  class="form-control" required>
          </div>
          <div class="form-group">
            <label for="energiadia">Energía generada al día (KWh)</label>
            <input type="number" step="0.01"  min="0" id="energiadia" name="energiadia" class="form-control" placeholder="Ingrese la energía generada al día" required>
          </div>
          <div class="form-group">
           <label for="tiempodiario">Tiempo de generación diaria (Horas:minutos)</label>
            <input type="text" id="tiempodiario" name="tiempodiario" class="form-control" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" title="Por ejemplo: 13:02" />
          </div>
          <div class="form-group">
            <label for="energiatotal">Energía total (KWh)</label>
            <input type="number" min="0" step="0.01" id="energiatotal" name="energiatotal" class="form-control" placeholder="Ingrese la energía total generada" required>
          </div>
          <div class="form-group">
            <label for="energiatotal">Tiempo total (Hrs)</label>
            <input type="number" min="0" step="0.01" id="tiempototal" name="tiempototal" class="form-control" placeholder="Ingrese la energía total generada" required>
          </div>
           <div class="form-group">
            <label for="instalacion">Instalación</label>
            <select class="form-control" id="instalacion" required>
                <option value="">Seleccione una de sus instalaciones:</option>
                <?php foreach ($instalacion as $datos): ?>
                <option value="<?php echo $datos['idinstalacion'] ?>"><?php echo $datos['nombreinstalacion']?></option> 
                <?php endforeach ?>
            </select>
          </div>
          <div id="equi" class="form-group">
          </div>
          <div class="modal-footer">
            <button id="cerrar" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-primary" value="Guardar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="exportexcel" class="btn btn-primary btn-info" data-toggle="modal" data-target="#excel" />
<div id="excel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elija  el rango de fechas para exportar los datos</h4>
      </div>
      <div class="modal-body">
        <?php echo validation_errors(); 
          $atr = array('target' => '_blank', 'id' =>'excelForm');
         echo form_open('datos/exportarExcel', $atr); ?>
        <div class="form-group">
            <label for="archivo">Nombre del archivo</label>
            <input id="archivo" type="text"  name="nombre" placeholder="Escriba el nombre de su archivo excel"  class="form-control" required>
        </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6"><label for="fecha1">Fecha de inicio</label></div>
              <div class="col-md-6"><label for="fecha2">Fecha de término</label></div>
            </div>
            <div class="row">
              <div class="col-md-6"><input id="fecha1" type="date"  name="fecha1"  class="form-control" required></div>
              <div class="col-md-6"><input id="fecha2" type="date"  name="fecha2"  class="form-control" required></div>
            </div>
          </div>
          <div class="modal-footer">
            <button id="cerrar2" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-primary" value="Exportar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

 <script type="text/javascript">
    $(document).ready(function () {
      var base_url = "<?=base_url()?>"; 
        $('#datosTabla').jtable({
            title: 'Datos generados',
            paging: true,
            pageSize: 5,
            sorting: true,
            multiSorting: true,
            defaultSorting: 'iddato ASC',
            messages: {
            noDataAvailable: 'No hay informacion disponible',
            areYouSure: '¿Estas seguro?',
            editRecord: 'Editar registro',
            deleteConfirmation: 'Este registro sera borrrado. ¿Está seguro?',
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
            toolbar: {
                items: [{
                    icon: base_url+'images/excel.png',
                    text: 'Exportar a Excel',
                    tooltip: 'Exportar los datos de un rango de fecha a formato excel',
                    click: function () {
                        $('#exportexcel').click();
                    }
                }]
            },
            actions: {
                listAction: base_url+'index.php/datos/listarDatos',
                updateAction: base_url+'index.php/datos/actualizarDato',
                deleteAction: base_url+'index.php/datos/borrarDato'
            },
            fields: {
                iddato: {
                    title: 'ID',
                    key: true,
                    width: '3%',
                    list: true
                    //Estas funciones serviran para personalizar como se muestran los datos
                    //create: true,
                    //display: function (data) {
                    //return '<b>'+data.record.iddato+'</b>';}
                    //input: function (data) {       
                    //return '<input id="hour" type="date"  name="fecha"  class="form-control" required/>';}
                },
                fecha: {
                    title: 'Fecha',
                    width: '3%',
                    type: 'date',
                    displayFormat: 'yy-mm-dd',
                    edit: true,
                    input: function (data) {
                      if (data.record) {
                          return '<input type="date" name="fecha" class="form-control" required value="' + data.record.fecha + '" />';
                      } 
                  }

                },
                hora: {
                    title: 'Hora',
                    width: '20%',
                    input: function (data) {
                      if (data.record) {
                          return '<input type="time" name="hora" class="form-control" required value="' + data.record.hora + '" />';
                      } 
                  }
                },
                energiageneradadia: {
                    title: 'Energía generada al día (KWh)',
                    width: '35%',
                    input: function (data) {
                      if (data.record) {
                          return '<input type="number" name="energiageneradadia" class="form-control" required value="' + data.record.energiageneradadia + '" />';
                      }
                  }
                },
                tiempogeneraciondiaria: {
                    title: 'Tiempo de generación diaria (Hrs:Seg)',
                    width: '35%',
                    input: function (data) {
                      if (data.record) {
                          return '<input type="text"  name="tiempogeneraciondiaria" class="form-control" required pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" value="' + data.record.tiempogeneraciondiaria + '" />';
                      } 
                  }
                },
                energiatotal: {
                    title: 'Energía total (KWh)',
                    width: '25%',
                    input: function (data) {
                      if (data.record) {
                          return '<input type="number" name="energiatotal" class="form-control" required value="' + data.record.energiatotal + '" />';
                      }
                  }   
                },
                 tiempototal: {
                    title: 'Tiempo total (Hrs)',
                    width: '35%',
                    input: function (data) {
                      if (data.record) {
                          return '<input type="number" name="tiempototal" class="form-control" required value="' + data.record.tiempototal + '" />';
                      }
                  }   
                },
                serie: {
                    title: 'Equipo',
                    width: '20%',
                    edit: false   
                }

            }
        });
//Re-load records when user click 'load records' button.
        $('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#datosTabla').jtable('load', {
                iddato: $('#dato').val()
            });
        });
 
       //Load all records when page is first shown
        $('#LoadRecordsButton').click();
          
    });
</script>
<script language="javascript">
$(document).ready(function() {
   // Interceptamos el evento submit
    $('#nuevosDat').submit(function() {
  // Enviamos el formulario usando AJAX
    var alerta = confirm('¿Esta seguro que desea registrar estos datos?');
    if(alerta)
    {
      $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                alert("DATOS REGISTRADOS");
                $("#nuevosDat")[0].reset();
                $('#datosTabla').jtable('reload');
            }
        })        
        return false;
    }
        
    }); 
});  
</script>
<script type="text/javascript">
$(document).ready(function(){ 
   $("#instalacion").change(function(evento){
    var inst = $('#instalacion').val();
      evento.preventDefault();
      $("#equi").load("equipos/listarEquiposIdInstalacion", {instalacion: inst});
   });
});
</script>