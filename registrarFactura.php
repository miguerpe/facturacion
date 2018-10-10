<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include "Database.php";
include "model/FacturaData.php";
include "model/DetalleData.php";
include "Executor.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(isset($_GET['idFactura'])){
		$noItem=1;
        $idFactura= $_GET['idFactura'];
        $idCliente= $_GET['idCliente'];
        $factura= FacturaData::getIdFactura($idFactura);
        if($factura){
			print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Factura ya Existe'
				)
            );
        }else{
?>
			    <form action="registrarDetalle.php">
					ID Factura <input type="text" name="idFactura" value="<?php echo $idFactura?>" />
					</br></br>
					idItem <input type="text" name="idItem" value="<?php echo $noItem?>" />
					Detalle <input type="text" name="detalle" value="" />
					cantidad <input type="text" name="cantidad" value="" />
					valor Unitario <input type="text" name="valorUnitario" value="" />
					
				<button>Insertar</button>
				
<?php 			
				$registro= new FacturaData();
				$registro->idFactura=$idFactura;
				$registro->idCliente=$idCliente;
				$registro->agregar();                

                //$registroN->agregar();
                print json_encode(
                    array(
                        'estado' => '1',
                        'mensaje' => 'Se registro la factura'
                        )
                    );                      
		}
		
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Registro creado'
				)
            );
            }else{
                print json_encode(
                    array(
                        'estado' => '2',
                        'mensaje'=> 'Ya existe un registro'
                    )
                );
            }    
        }else{
            //Insertar Factura en BD
                print json_encode(
                    array(
                        'estado' => '3',
                        'mensaje' => 'No hay numero  de factura'
                    )
                );
        }
    