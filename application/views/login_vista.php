<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><?php echo $title; ?></title>
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
        
        <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		
    </head>
    <body>
    <img src="<?php echo base_url();?>images/logotipo.png" alt="logotipo" height="85" width="254">
        <div class="container">
		
			<!-- Codrops top bar -->
			
			<section class="main">
					<?php // provee el formulario para hacer  log in
			     echo validation_errors();
			     $class = array('class' => 'form-2');
			     echo form_open('login', $class);    
				?>
				<div class="LoginUsuariosError">
			    <?php
			    if(isset($error)) { echo "<p>".$error."</p>"; }
			    echo form_error('login');
			    ?>
				</div>
					<h1><span class="log-in">Ecoenergiza: </span><span class="sign-up">RaspiNet</span></h1>
					<p class="float">
						<label for="nick"><i class="icon-user"></i>Usuario</label>
						<input type="text" name="nick" placeholder="Nombre de usuario" required></i>
					</p>
					<p class="float">
						<label for="password"><i class="icon-lock"></i>Password</label>
						<input type="password" name="password" placeholder="Password">
					</p>
					<p class="clearfix"> 
						
						<input type="submit" name="ingresar" value="Iniciar sesión">
					</p>
				</form>​​
			</section>
			
        </div>
	
        
    </body>
</html>

