<div id="raspiVideosTabla" style="width: 1000px;"></div>

<script type="text/javascript">
    $(document).ready(function () {
      var base_url = "<?=base_url()?>"; 
        $('#raspiVideosTabla').jtable({
            title: 'Datos generados',
            paging: true,
            pageSize: 5,
            sorting: true,
            multiSorting: true,
            defaultSorting: 'idraspivideo ASC',
            messages: {
            noDataAvailable: 'No hay informacion disponible',
            pagingInfo: 'Mostrando {0}-{1} de {2} registros',
            pageSizeChangeLabel: 'Numero de filas en la tabla',
            gotoPageLabel: 'Ir a la pagina:'
            },
            actions: {
                listAction: base_url+'index.php/raspivideo/listarRaspiVideos'
            },
            fields: {
                idraspivideo: {
                    title: '#',
                    key: true,
                    width: '5%'
                },
                fecha: {
                    title: 'Fecha',
                    width: '10%',
                    type: 'date',
                    width: '10%',
                    displayFormat: 'dd-mm-yy'
                },
                tiempo: {
                    title: 'Tiempo de reproduccion',
                    width: '17%'
                },
                raspimac: {
                    title: 'Dispositivo',
                    width: '20%'
                },
                ubicacion: {
                    title: 'Ubicación',
                    width: '20%'
                },
                estadonombre: {
                    title: 'Estado',
                    width: '10%'
                }
            }
        });
          $('#raspiVideosTabla').jtable('load');
    });
</script>