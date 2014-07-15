<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Raspberry extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $nombre = $this->session->userdata('nom');
        $this->load->helper('url');
        if(!($nombre))
        {
           redirect('login');
        }
        $this->load->helper(array('form', 'html'));
    }

	public function index()
	{
		$this->load->model('state_modelo');
		$data['state'] = $this->state_modelo->listarEstados();
		$this->load->view('raspberry/raspberry_vista', $data);
	}

	public function listarDispositivo()
	{
		$this->load->model('raspberry_modelo');
		$datos = $this->raspberry_modelo->listarDispositivo();
		$data = array();
		
		foreach($datos as $key)
                    {
                    	$data[] = $key;
                    }

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $data;
		print json_encode($jTableResult);

	}

	public function nuevoDispositivo()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('mac', 'Mac', 'trim|required');
		$this->form_validation->set_rules('estado', 'Estado', 'trim|required');
		$this->form_validation->set_rules('ubicacion', 'Ubicacion', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
			   exit();
			}
			else
			{
				$this->load->model('raspberry_modelo');
				$this->raspberry_modelo->nuevoDispositivo();
			}
		
	}

	public function actualizarDispositivo()
	{
		$mac = $this->input->post('mac');
		$estado = $this->input->post('estado');
		$ubicacion = $this->input->post('ubicacion');

		$this->load->model('raspberry_modelo');
		$this->raspberry_modelo->actualizarDispositivo($mac, $estado, $ubicacion);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	public function borrarDispositivo()
	{
		$mac = $this->input->post('mac');
		$this->load->model('raspberry_modelo');
		$this->raspberry_modelo->borrarDispositivo($mac);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

}

/* End of file instalacion.php */
/* Location: ./application/controllers/instalacion.php */
?>