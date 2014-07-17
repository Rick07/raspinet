<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Raspivideo extends CI_Controller {

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

	public function index()
	{   
        $this->load->view('raspivideos/raspivideo_vista');
	}


    public function listarRaspiVideos()
    {
       $this->load->model('raspivideo_modelo');
        $datos = $this->raspivideo_modelo->listarRaspiVideos();
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

}

/* End of file datos.php */
/* Location: ./application/controllers/datos.php */
?>