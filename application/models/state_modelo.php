<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class State_modelo extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		
	}

	public function listarEstados()
	{
		//$query = $this->db->select('sName AS nombreEstado, sCode AS codigoEstado');
		$query = $this->db->get('state');
        return $query->result_array();
	}

}

/* End of file state_modelo.php */
/* Location: ./application/models/state_modelo.php */
?>