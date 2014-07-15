<?php

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->library('session');
        $nombre = $this->session->userdata('nom');
        $this->load->helper('url');
        if(!($nombre))
        {
           redirect("login");
        }
        $this->load->helper(array('form', 'html'));
	}

  public function index()
  {
    $data['id'] = $this->session->userdata('idusu');
    $data['nombre'] = $this->session->userdata('nom');
    $this->load->view('main_vista', $data);
  }

  public function salir()
  { 
      $this->session->sess_destroy();//cerramos la sesion
      redirect("login");
  }

}

/* End of file main.php */
/* Location: ./application/views/main.php */
?>