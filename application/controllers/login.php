<?php

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
	
		if (!$this->agent->is_browser('Chrome') && !$this->agent->is_browser('Safari') && !$this->agent->is_browser('Opera'))
				{
					show_404();
				}

    }

    public function index()
    {
        $this->load->helper(array('form', 'url', 'html'));

    	$this->load->library('form_validation');
        $data['title']="RaspiNet";

    	$ingresar = $this->input->post('ingresar');
    	if(!$ingresar)
    	{
    		$this->load->view('login_vista', $data);
    	}
    	else
    	{
    		$this->form_validation->set_rules('nick', 'Nombre de usuario', 'trim|required');
    		$this->form_validation->set_rules('password', 'contraseña', 'trim|required|md5');

    		if($this->form_validation->run() == FALSE)
    		{
                $this->load->view('login_vista', $data);
    		}
    		else
    		{
    			$this->load->model('login_modelo');
                $nick = $this->input->post('nick');
                $pass = $this->input->post('password');
                $iniciar = $this->login_modelo->verificarLogin($nick, $pass); 

    			if($iniciar)
    			{
                    $this->load->library('session');
                    $usuario = $this->login_modelo->getUsuarioIdNombre($nick);
                    $this->session->set_userdata($usuario);
                    redirect("main");
    			}
    			else
    			{
                    $data['title']="RaspiNet";
    				$data['error']="No Estas Autorizado, por favor ingresa correctamente tus datos para acceder al sistema.";
					//$data['error']="SE ESTA REALIZANDO MANTENIMIENTO EN ESTE MOMENTO. POR FAVOR INTENTA ACCEDER MAS TARDE.";
                    $this->load->view('login_vista', $data);
    			}
    		}
    	}
    }

}

 ?>
