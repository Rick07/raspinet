<?php

class Raspivideo_modelo extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function listarRaspiVideos($jtSorting, $jtStartIndex, $jtPageSize)
	{
			$sql="SELECT
				raspivideo.idraspivideo AS idraspivideo,
				raspivideo.fecha AS fecha,
				DATE_FORMAT(raspivideo.tiempo, '%H:%i:%s') AS tiempo,
				raspivideo.raspimac AS raspimac,
				raspberry.ubicacion AS ubicacion,
				state.sName AS estadonombre
				FROM
				raspivideo
				INNER JOIN raspberry ON raspivideo.raspimac = raspberry.mac
				INNER JOIN state ON raspberry.estado = state.sCode
				ORDER BY
				$jtSorting
				LIMIT $jtStartIndex, $jtPageSize";
		
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function totalRaspiVideos()
	{
		$sql="SELECT
				Count(raspivideo.idraspivideo) AS record
				FROM
				raspivideo
				INNER JOIN raspberry ON raspivideo.raspimac = raspberry.mac
				INNER JOIN state ON raspberry.estado = state.sCode";

		$query = $this->db->query($sql);

		return  $query->result_array();
	}
}

/* End of file data_modelo.php */
/* Location: ./application/models/data_modelo.php */
?>