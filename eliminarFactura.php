<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

include "Database.php";
include "model/RegistroData.php";
include "model/MascotaData.php";
include "Executor.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if(isset($_GET['idMascota'])){
        $idMascota= $_GET['idMascota'];
        $mascota= MascotaData::getPorNickname($idMascota);
        if($mascota){
            //verifica el ingreso en el dia sin salida
            $registro= RegistroData::getEntradaDia($mascota->nickname); 
            if (empty($registro)){
                //Verifica salida día anterior
                $registroAnt= RegistroData::getSalidaAnt($mascota->nickname);
                //print $mascota->nickname;
                //print $registroAnt->horaEntrada;
                if(empty(!$registroAnt)){
                    //print date('G', strtotime($registroAnt->horaEntrada));
                    if (date('G', strtotime($registroAnt->horaEntrada))<16){
                        $fecha= date("Y-m-d", strtotime('-1 day'));
                        $hora= "20:00:00";
                        $registroAnt->actualizarSalida($fecha." ".$hora);
                        //$registroAnt->actualizarSalida("2018-05-09 20:00:00");
                        $registroN= new RegistroData();
                        $registroN->nickname=$mascota->nickname;
                        $registroN->horaEntrada=$fecha." ".$hora;
                        $fecha2= date("Y-m-d H:i:s");
                        //print "F2".$fecha2."F2";
                        $registroN->horaSalida=$fecha2;
                        $registroN->insertar();
                        print json_encode(
                            array(
                                'estado' => '6',
                                'mensaje' => 'Se registro registro Noche'
                            )
                        );                      
                    }else{
                        $registroAnt->actualizarSalida();
                        print json_encode(
                            array(
                                'estado' => '7',
                                'mensaje' => 'Se actualizo salida del dia de ayer'
                            )
                        );                        
                    }
                }else{
                    print json_encode(
                        array(
                            'estado' => '2',
                            'mensaje' => 'No se encontró ingreso sin salida reciente'
                        )
                    );                      
                }
                //Fin
            }else{
                $registro[0]->actualizarSalida();
                print json_encode(
                    array(
                        'estado' => '1',
                        'mensaje'=> 'Se Actualizó la salida correctamente'
                    )
                );
            }    
        }else{
            //Insertar Mascota en BD
                print json_encode(
                    array(
                        'estado' => '5',
                        'mensaje' => 'Mascota No existe'
                    )
                );
        }
    }else {
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}