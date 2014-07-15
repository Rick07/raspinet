<?php

class Datos_modelo extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function listarDatosIdDist($id, $iddato, $jtSorting, $jtStartIndex, $jtPageSize)
	{
		if ($iddato=="") {
			# code...
			$sql="SELECT
				datos.iddato AS iddato,
				datos.fecha AS fecha,
				DATE_FORMAT(datos.hora, '%H:%i') AS hora,
				datos.energiageneradadia AS energiageneradadia,
				DATE_FORMAT(datos.tiempogeneraciondiaria, '%h:%i') AS tiempogeneraciondiaria,
				datos.energiatotal AS energiatotal,
				datos.tiempototal AS tiempototal,
				equipo.serie AS serie
				FROM
				datos
				INNER JOIN equipo ON datos.equipoid = equipo.idequipo
				INNER JOIN instalacion ON equipo.instalacionid = instalacion.idinstalacion
				INNER JOIN distribuidor ON instalacion.distribuidorid = distribuidor.iddistribuidor
				WHERE
				instalacion.distribuidorid = $id
				ORDER BY
				$jtSorting
				LIMIT $jtStartIndex, $jtPageSize";
		}
		else
		{
			$sql="SELECT
				datos.iddato AS iddato,
				datos.fecha AS fecha,
				DATE_FORMAT(datos.hora, '%H:%i') AS hora,
				datos.energiageneradadia AS energiageneradadia,
				DATE_FORMAT(datos.tiempogeneraciondiaria, '%h:%i') AS tiempogeneraciondiaria,
				datos.energiatotal AS energiatotal,
				datos.tiempototal AS tiempototal,
				equipo.serie AS serie
				FROM
				datos
				INNER JOIN equipo ON datos.equipoid = equipo.idequipo
				INNER JOIN instalacion ON equipo.instalacionid = instalacion.idinstalacion
				INNER JOIN distribuidor ON instalacion.distribuidorid = distribuidor.iddistribuidor
				WHERE
				instalacion.distribuidorid = $id AND
				datos.iddato = $iddato
				ORDER BY
				$jtSorting
				LIMIT $jtStartIndex, $jtPageSize";
		}
		
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function totalDatosIdDist($id, $iddato)
	{
		if ($iddato == "") {
			# code...
			$sql = "SELECT
				Count(datos.iddato) AS record
				FROM
				datos
				INNER JOIN equipo ON datos.equipoid = equipo.idequipo
				INNER JOIN instalacion ON equipo.instalacionid = instalacion.idinstalacion
				INNER JOIN distribuidor ON instalacion.distribuidorid = distribuidor.iddistribuidor
				WHERE
				instalacion.distribuidorid = $id";
		}
		else
		{
			$sql = "SELECT
				Count(datos.iddato) AS record
				FROM
				datos
				INNER JOIN equipo ON datos.equipoid = equipo.idequipo
				INNER JOIN instalacion ON equipo.instalacionid = instalacion.idinstalacion
				INNER JOIN distribuidor ON instalacion.distribuidorid = distribuidor.iddistribuidor
				WHERE
				instalacion.distribuidorid = $id AND
				datos.iddato = $iddato";
		}
		
		$query = $this->db->query($sql);

		return  $query->result_array();
	}

	public function newData()
	{
		$data = array('fecha' => $this->input->post('fecha'),
			'hora' => $this->input->post('hora'),
			'energiageneradadia' => $this->input->post('energiadia'),
			'tiempogeneraciondiaria' => $this->input->post('tiempodiario'),
			'energiatotal' => $this->input->post('energiatotal'),
			'tiempototal' => $this->input->post('tiempototal'),
			'equipoid' => $this->input->post('equipo'));

		return $this->db->insert('datos', $data);
	}

	public function borrarDato($id)
	{
		$this->db->where('iddato', $id);
		
		return $this->db->delete('datos');
	}

	public function actualizarDato($id, $fecha, $hora, $egd, $tgd, $et, $tt)
	{
		$datos = array(
               'fecha' => $fecha,
               'hora' => $hora,
               'energiageneradadia' => $egd,
               'tiempogeneraciondiaria' => $tgd,
               'energiatotal' => $et,
               'tiempototal' => $tt
            );

		$this->db->where('iddato', $id);
		return $this->db->update('datos', $datos);
	}

	public function exportarExcel($id, $fecha1, $fecha2)
	{
		$sql="SELECT
				datos.fecha AS fecha,
				DATE_FORMAT (datos.hora, '%H:%i') AS hora,
				datos.energiageneradadia AS energiageneradadia,
				DATE_FORMAT (datos.tiempogeneraciondiaria, '%H:%i') AS tiempogeneraciondiaria,
				datos.energiatotal AS energiatotal,
				datos.tiempototal AS tiempototal,
				equipo.serie AS serie,
				distribuidor.nombre AS nombre
				FROM
				datos
				INNER JOIN equipo ON datos.equipoid = equipo.idequipo
				INNER JOIN instalacion ON equipo.instalacionid = instalacion.idinstalacion
				INNER JOIN distribuidor ON instalacion.distribuidorid = distribuidor.iddistribuidor
				WHERE
				instalacion.distribuidorid = $id AND
				datos.fecha BETWEEN '$fecha1' AND '$fecha2'
				ORDER BY
				iddato DESC";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

}

/* End of file data_modelo.php */
/* Location: ./application/models/data_modelo.php */
?>