<!DOCTYPE html>
<html>
  <head>
    <title>RaspiNet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url()?>css/blitzer/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <!-- Jquery -->
    <script src="<?php echo base_url()?>js/jquery-1.8.2.min.js"></script>
    <script src="<?php echo base_url()?>js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/navtabs.js"></script>
    <!-- Include one of jTable styles. -->
    <link href="<?php echo base_url()?>js/jtable/themes/lightcolor/blue/jtable.min.css" rel="stylesheet" type="text/css" />
    <!-- Include jTable script file. -->
    <script src="<?php echo base_url()?>js/jtable/jquery.jtable.js" type="text/javascript"></script>
     <!-- Bootstrap -->
    <script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="col-md-3 col-md-offset-9">
        <ul class="nav nav-pills nav-stacked">
          <li class="active">
            <a href="<?php echo base_url()?>index.php/main/salir">
              <span class="badge pull-right">Cerrar Sesión</span>
              <?php echo $nombre?>
            </a>
          </li>
         </ul>
    </div>
     <img src="<?php echo base_url();?>images/logotipo.png" alt="logotipo" height="85" width="254">
   <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="active" id="dispositivos"><a href="#dispositivos" data-toggle="tab">Dispositivos</a></li>
    <li id="monitor"><a href="#monitor" data-toggle="tab">Monitoreo de datos</a></li>
    <!--<li id="tablero"><a href="#tablero" data-toggle="tab">Tablero de datos</a></li>-->
  </ul>
<div id="seccion"></div>
</body>
</html> 