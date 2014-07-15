<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $nombre = $this->session->userdata('nombre');
        $this->load->helper(array('form', 'url', 'html'));
        if(!($nombre))
        {
           redirect('login');
        }
        $this->load->model('instalaciones_modelo');
    }

	public function index()
	{
        $id = $this->session->userdata('id');
        $data['instalacion'] = $this->instalaciones_modelo->listarInstalacionesIdDist($id);
        $this->load->view('datos/datos_vista', $data);
	}

    public function excelVista()
    {
        $id = $this->session->userdata('id');
        $data['instalacion'] = $this->instalaciones_modelo->listarInstalacionesIdDist($id);
        $this->load->view('datos/ingresaExcelVista', $data);
    }

    public function listarDatos()
    {
        $id = $this->session->userdata('id');
        $iddato = $this->input->post('iddato');
        $this->load->model('datos_modelo');
        $recordCount = $this->datos_modelo->totalDatosIdDist($id, $iddato);

        foreach ($recordCount as $key) {
            $record = $key['record'];
        }

        $jtSorting = $this->input->get('jtSorting', TRUE);
        $jtStartIndex = $this->input->get('jtStartIndex', TRUE);
        $jtPageSize = $this->input->get('jtPageSize', TRUE);
        
        $datos = $this->datos_modelo->listarDatosIdDist($id, $iddato, $jtSorting, $jtStartIndex, $jtPageSize);

        $data = array();
        
        foreach($datos as $key)
                    {
                        $data[] = $key;
                    }

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $record;
        $jTableResult['Records'] = $data;
        print json_encode($jTableResult);

    }

    public function newData()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('energiadia', 'Energia generada al dia', 'trim|required');
        $this->form_validation->set_rules('tiempodiario', 'Tiempo de generacion diaria', 'trim|required');
        $this->form_validation->set_rules('energiatotal', 'Energia total', 'trim|required');
        $this->form_validation->set_rules('tiempototal', 'Tiempo total', 'trim|required');
        $this->form_validation->set_rules('equipo', 'Equipo', 'trim|required');
        if($this->form_validation->run() == FALSE)
            {
               exit();
            }
            else
            {
                $this->load->model('datos_modelo');
                $this->datos_modelo->newData();
            }
    }

    public function borrarDato()
    {
        $id = $this->input->post('iddato');
        $this->load->model('datos_modelo');
        $this->datos_modelo->borrarDato($id);

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }

    public function actualizarDato()
    {
        $id = $this->input->post('iddato');
        $fecha = $this->input->post('fecha');
        $hora = $this->input->post('hora');
        $egd = $this->input->post('energiageneradadia');
        $tgd = $this->input->post('tiempogeneraciondiaria');
        $et = $this->input->post('energiatotal');
        $tt = $this->input->post('tiempototal');

        $this->load->model('datos_modelo');
        $this->datos_modelo->actualizarDato($id, $fecha, $hora, $egd, $tgd, $et, $tt);

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }

	public function importarDatosExcel(){
    	//Cargar PHPExcel library
        $this->load->library('Excel');
        $idequipo = $this->input->post('equipo');
        $url = base_url().'index.php/main';
 
    	$name   = $_FILES['file']['name'];
     	$tname  = $_FILES['file']['tmp_name'];
 
        $obj_excel = PHPExcel_IOFactory::load($tname);       
       	$sheetData = $obj_excel->getActiveSheet()->toArray(true, true,true,true,true,true);
 
       	$arr_datos = array();
       	foreach ($sheetData as $index => $value) {            
            if ( $index != 1 ){
                $arr_datos = array(
                    'fecha'  =>  $value['A'],
                    'hora' =>  (string)$value['B'],
                    'energiageneradadia'  =>  (double)$value['C'],                                        
                    'tiempogeneraciondiaria'  =>  (string)$value['D'],
                    'energiatotal'  =>  (int)$value['E'],
                    'tiempototal'  =>  (double)$value['F'],
                    'equipoid'  =>  $idequipo,
                ); 
		foreach ($arr_datos as $llave => $valor) {
			$arr_datos[$llave] = $valor;
		}
        $this->load->database();
		$this->db->insert('datos',$arr_datos);
        echo "<script language='JavaScript'>
             {
               alert('Datos importados correctamente');  
               setTimeout(location.href='$url', 2000);}
                </script>";     	
            } 
       	}
       	
    }

    public function exportarExcel()
    {
        $this->load->library('Excel');
        $id = $this->session->userdata('id');
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        $nombre = $this->input->post('nombre');

        // Se crea el objeto PHPExcel
        $objPHPExcel = new PHPExcel();

            /* Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Ricardo") // Nombre del autor
        ->setLastModifiedBy("Ricardo") //Ultimo usuario que lo modificó
        ->setTitle("Reporte Excel con PHP y MySQL") // Titulo
        ->setSubject("Reporte Excel con PHP y MySQL") //Asunto
        ->setDescription("Reporte de datos de equipo") //Descripción
        ->setKeywords("reporte de datos de equipo") //Etiquetas
        ->setCategory("Reporte excel"); //Categorias*/

        $titulosColumnas = array('Fecha', 'Hora', 'Energía Generada al Día KWh', 'Tiempo de Generación Diaria', 'Energía Total', 'Tiempo Total', 'Equipo', 'Usuario');

        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1',  $titulosColumnas[0])  //Titulo de las columnas
        ->setCellValue('B1',  $titulosColumnas[1])
        ->setCellValue('C1',  $titulosColumnas[2])
        ->setCellValue('D1',  $titulosColumnas[3])
        ->setCellValue('E1',  $titulosColumnas[4])
        ->setCellValue('F1',  $titulosColumnas[5]);

        //Se agregan los datos de los alumnos
        $this->load->model('datos_modelo');
        $dato = $this->datos_modelo->exportarExcel($id, $fecha1, $fecha2);
 
        $i=2;
         foreach($dato as $key)
         {
                $objPHPExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$i, $key['fecha'])
                 ->setCellValue('B'.$i, $key['hora'])
                 ->setCellValue('C'.$i, $key['energiageneradadia'])
                 ->setCellValue('D'.$i, $key['tiempogeneraciondiaria'])
                 ->setCellValue('E'.$i, $key['energiatotal'])
                 ->setCellValue('F'.$i, $key['tiempototal']);
            $i++;
         }

         for($i = 'A'; $i <= 'H'; $i++){
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
            }

                     // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=$nombre.xlsx");
            header('Cache-Control: max-age=0');
             
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
    }

}

/* End of file datos.php */
/* Location: ./application/controllers/datos.php */
?>