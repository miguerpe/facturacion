<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include "Database.php";
include "model/FacturaData.php";
include "model/DetalleData.php";
include "Executor.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(isset($_GET['idFactura'])){
        $idFactura= $_GET['idFactura'];
        $idItem= $_GET['idItem'];
        $detalle= $_GET['detalle'];
        $cantidad= $_GET['cantidad'];
        $valorUnitario= $_GET['valorUnitario'];
        $factura= FacturaData::getIdFactura($idFactura);
        if($factura){
                $registroN= new detalleData();
?>
<?php 			
				$idItem++;
                $registroN->idFactura=$idFactura;
                $registroN->idItem=$idItem;
                $registroN->detalle=$detalle;
                $registroN->cantidad=$cantidad;
                $registroN->valorUnitario=$valorUnitario;
                //$registroN->fecha=$fecha." ".$hora;
                $registroN->agregar();
                print json_encode(
                    array(
                        'estado' => '1',
                        'mensaje' => 'Se registro el nuevo item'
                        )
                    );   

        }else{
						print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Factura no Existe'
				)
            );
                   
		}}else{
                print json_encode(
                    array(
                        'estado' => '2',
                        'mensaje'=> 'Ya existe un registro'
                    )
                );
            }    
        }
		
		
    