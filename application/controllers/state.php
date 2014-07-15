<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class State extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $nombre = $this->session->userdata('nom');
        $this->load->helper(array('form', 'url', 'html'));
        if(!($nombre))
        {
           redirect('login');
        }
    }

    public function listarEstados()
    {
        $this->load->model('state_modelo');
        $datos = $this->state_modelo->listarEstados();
         

        foreach($datos as $key)
                    {
                        $data[] =  array('DisplayText' => $key['sName'],
                                    'Value' => $key['sCode']);
                    }

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Options'] = $data;
        print json_encode($jTableResult);
    }

}

/* End of file state.php */
/* Location: ./application/controllers/state.php */
?>