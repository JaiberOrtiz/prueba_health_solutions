<?php 
include_once "../view/Cotizacion/CotizacionGeneral.php";
include_once "../model/CotizacionDao.php";
class CotizacionController extends CotizacionGeneral{

    public function getResultados(){
        $cotDao = new CotizacionDao();
        $data = $cotDao->select();
        CotizacionGeneral::consultarCotizacion($data);
    }

    public function obtenerResultadosBusqueda(){
        extract(extractPost($_POST));
        $cotDao = new CotizacionDao();

        if (empty($valor)) {
            $data = $cotDao->select(); 
        } else {
            $id = $valor;
            $data = $cotDao->select(' WHERE com_quotation.com_quotation_id = ' . $id);
        }
        
        echo json_encode($data);
    }
}