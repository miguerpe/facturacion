<?php
class RegistroData {
	public static $tablename = "registro";



	public function __construct(){
		$this->horaEntrada = date("Y-m-d H:i:s");
		$this->horaSalida = NULL;
	}

        public function verificarRegistro($nickname,$tipo){
            $hora = date("G");
            $fecha = date("d-m-Y");
            if ($tipo=1){
            if ($hora<16){
                $sql = "select * from ".self::$tablename."Where nickname=$nickname and hour(horaEntrada)<16" ;
            }else{
                $sql = "select * from ".self::$tablename."Where nickname=$nickname and hour(horaEntrada)>15" ;
            }
            }else{
                
            }
            $query = Executor::doit($sql);
            $found = null;
            $data = new RegistroData();
            while($r = $query[0]->fetch_array()){
		$data->nickname = $r['nickname'];
		$data->horaEntrada = $r['horaEntrada'];
		$data->s1 = $r['s1'];
		$data->s2 = $r['s2'];
		$data->horaSalida = $r['horaSalida'];
		$data->pagado = $r['pagado'];
		$found = $data;
		break;
            }
            return $found;
        }
	public function insertar(){
		$sql = "insert into ".self::$tablename." (nickname,horaEntrada,horaSalida) ";
                if(is_null($this->horaSalida)){
                    $sql .= "values ('$this->nickname','$this->horaEntrada',NULL)";
                }else{
                    $sql .= "values ('$this->nickname','$this->horaEntrada','$this->horaSalida')";
                }
                print_r($sql);
		return Executor::doit($sql);
	}
	public function insertarNocturno(){
		$sql = "insert into ".self::$tablename." (nickname,horaEntrada,horaSalida) ";
		$sql .= "values ('$this->nickname',NOW(),horaSalida)";
		return Executor::doit($sql);
	}
	public static function eliminarPorNickname($nickname,$horaEntrada){
		$sql = "delete from ".self::$tablename." where nickname=$nickname and horaEntrada=$horaEntrada";
		Executor::doit($sql);
	}
//	public function eliminar(){
//		$sql = "delete from ".self::$tablename." where nickname=$this->nickname";
//		Executor::doit($sql);
//	}

        // partiendo de que ya tenemos creado un objecto Registro previamente utilizamos el contexto
	public function actualizarS1(){
		//$sql = "update ".self::$tablename." set s1=1 where nickname=$this->nickname and hour(horaEntrada)<16";
		$sql = "update ".self::$tablename." set s1=1 where nickname='$this->nickname' and horaEntrada='$this->horaEntrada'";
		Executor::doit($sql);
	}
	public function actualizarS2(){
		$sql = "update ".self::$tablename." set s2=1 where nickname='$this->nickname' and horaEntrada='$this->horaEntrada'";
		Executor::doit($sql);
	}
        public function actualizarSalida($horaSalida=NULL){
                if (is_null($horaSalida)){$horaSalida= date('Y-m-d H:i:s');}
                print "#".$horaSalida."#";
                $sql = "update ".self::$tablename." set horaSalida='$horaSalida' where nickname='$this->nickname' and horaEntrada='$this->horaEntrada'";
                Executor::doit($sql);
        }
        public static function getPaseo($nickname,$paseo)
        {
            $fecha= date("d-m-Y");
            if($paseo==1){
                $sql="select * from ".self::$tablename." WHERE s1=0 AND DATE_FORMAT(horaEntrada,'%d-%m-%Y')='".$fecha."' and horaSalida IS NULL and nickname='".$nickname."'";
            }else{
                $sql="select * from ".self::$tablename." WHERE s2=0 AND DATE_FORMAT(horaEntrada,'%d-%m-%Y')='".$fecha."' and horaSalida IS NULL and nickname='".$nickname."'";
            }    
            $query = Executor::doit($sql);
            $found = null;
            $data = new RegistroData();
            while($r = $query[0]->fetch_array()){
                $data->nickname = $r['nickname'];
                $data->horaEntrada = $r['horaEntrada'];
                $data->s1 = $r['s1'];
                $data->s2 = $r['s2'];
                $data->horaSalida = $r['horaSalida'];
                $data->pagado = $r['pagado'];
                $found = $data;
                break;
            }
            return $found;
        }

	public static function getPorNickname($nickname,$jornada){
                if ($jornada==0){
                    $sql = "select * from ".self::$tablename." where nickname=$nickname and hour(horaEntrada)<16";
                }else{
                    $sql = "select * from ".self::$tablename." where nickname=$nickname and hour(horaEntrada)>15";
                }   
		$query = Executor::doit($sql);
		$found = null;
		$data = new RegistroData();
		while($r = $query[0]->fetch_array()){
                    $data->nickname = $r['nickname'];
                    $data->horaEntrada = $r['horaEntrada'];
                    $data->s1 = $r['s1'];
                    $data->s2 = $r['s2'];
                    $data->horaSalida = $r['horaSalida'];
                    $data->pagado = $r['pagado'];
                    $found = $data;
                    break;
		}
		return $found;
	}



	public static function getTodo(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new MascotaData();
			$array[$cnt]->nickname = $r['nickname'];
			$array[$cnt]->horaEntrada = $r['nombreMascota'];
			$array[$cnt]->s1 = $r['nombreDueno'];
			$array[$cnt]->s2 = $r['nickname'];
			$array[$cnt]->horaSalida = $r['nickname'];
			$array[$cnt]->pagado = $r['nickname'];
			$cnt++;
		}
		return $array;
	}
        
        public static function getPendientesDia(){
            $hora = date("G");
            $fecha = date("d-m-Y");
            //echo $hora." ".$fecha;
            //echo date("h:i:sa");
            if($hora<12){
                $sql = "select * from ".self::$tablename." WHERE s1=0 AND DATE_FORMAT(horaEntrada,'%d-%m-%Y')='".$fecha."'";
            }else{
                $sql ="select * from ".self::$tablename." WHERE s2=0 AND DATE_FORMAT(horaEntrada,'%d-%m-%Y')='".$fecha."'";
            }  
            //echo "<script>alert('".$sql."');</script>";
            $query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new RegistroData();
			$array[$cnt]->nickname = $r['nickname'];
			$array[$cnt]->horaEntrada = $r['horaEntrada'];
			$array[$cnt]->s1 = $r['s1'];
			$array[$cnt]->s2 = $r['s2'];
			$array[$cnt]->horaSalida = $r['horaSalida'];
			$array[$cnt]->pagado = $r['pagado'];
			$cnt++;
		}
		return $array;
        }
        
        public static function getEntradaDia($id){
            $sql = "select * from ".self::$tablename." WHERE nickname='".$id."' and DATE_FORMAT(horaEntrada,'%d-%m-%Y')=DATE_FORMAT(now(),'%d-%m-%Y') and horaSalida IS NULL";
            $query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new RegistroData();
			$array[$cnt]->nickname = $r['nickname'];
			$array[$cnt]->horaEntrada = $r['horaEntrada'];
			$array[$cnt]->s1 = $r['s1'];
			$array[$cnt]->s2 = $r['s2'];
			$array[$cnt]->horaSalida = $r['horaSalida'];
			$array[$cnt]->pagado = $r['pagado'];
			$cnt++;
		}
		return $array;
        }
        
        public static function getSalidaAnt($id){
            $sql = "select * from ".self::$tablename." WHERE nickname='".$id."' and DATE_FORMAT(horaEntrada,'%d-%m-%Y')=DATE_FORMAT(date_add(now(),INTERVAL -1 DAY),'%d-%m-%Y') and horaSalida IS NULL";
            $query = Executor::doit($sql);
            $found = null;
            $data = new RegistroData();
            while($r = $query[0]->fetch_array()){
                $data->nickname = $r['nickname'];
                $data->horaEntrada = $r['horaEntrada'];
                $data->s1 = $r['s1'];
                $data->s2 = $r['s2'];
                $data->horaSalida = $r['horaSalida'];
                $data->pagado = $r['pagado'];
                $found = $data;
                break;
            }
            return $found;     
        }
}
?>