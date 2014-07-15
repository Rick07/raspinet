<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Raspberry_modelo extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function listarDispositivo()
	{
		$query = $this->db->join('state', 'raspberry.estado = state.sCode');
		$query = $this->db->get('raspberry');
		return $query->result_array();
	}

	public function nuevoDispositivo()
	{
		$data = array('mac' => $this->input->post('mac'),
			'estado' => $this->input->post('estado'),
			'ubicacion' => $this->input->post('ubicacion'));

		return $this->db->insert('raspberry', $data);
	}

	public function actualizarDispositivo($mac, $estado, $ubicacion)
	{
		$datos = array(
               'estado' => $estado,
               'ubicacion' => $ubicacion
            );

		$this->db->where('mac', $mac);
		
		return $this->db->update('raspberry', $datos);
	}

	public function borrarDispositivo($mac)
	{
		$this->db->where('mac', $mac);
		
		return $this->db->delete('raspberry');
	}

}

/* End of file Raspberry_modelo.php */
/* Location: ./application/models/Raspberry_modelo.php */
?>