<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "Database.php";
include "model/FacturaData.php";
include "Executor.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
$facturas = FacturaData::getTodo();
    if ($facturas) {
        $datos["estado"] = 1;
        $datos["facturas"] = $facturas;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}else{
    print json_encode(array(
            "estado" => 3,
            "mensaje" => "Ha ocurrido un error"
        ));
}