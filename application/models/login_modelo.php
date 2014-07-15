<?php

class Login_modelo extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		
	}

	public function verificarLogin($nick, $pass)
	{
		$query = $this->db->where('nick', $nick);
		$query = $this->db->where('password', $pass);
		$query = $this->db->get('usuario');

		return $query->row();
	}

	public function getUsuarioIdNombre($nick)
	{
		
		$query = $this->db->where('nick', $nick);
		$query = $this->db->get('usuario');

		$dato = $query->result_array();

		 foreach($dato as $key)
                    {
                    	$idusu = $key['idusuario'];
                        $nom = $key['nombre'];
                    }

         $datos = array('idusu' => $idusu,
         				'nom' => $nom);

		 return $datos;
	}

}