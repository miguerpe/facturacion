<?php
class FacturaData {
	public static $tablename = "factura";

	public function __construct(){
                $this->fecha = getdate();
	}

	public function agregar(){
		$sql = "insert into ".self::$tablename." (idFactura,idCliente,fecha) ";
		$sql .= "values ($this->idFactura,$this->idCliente,now())";
		return Executor::doit($sql);
	}

	public static function eliminarPorID($idFactura){
		$sql = "delete from ".self::$tablename." where idFactura=$nickname";
		Executor::doit($sql);
	}
	public function eliminar(){
		$sql = "delete from ".self::$tablename." where idFactura=$this->idFactura";
		Executor::doit($sql);
	}

	public static function getIdFactura($idFactura){
		$sql = "select * from ".self::$tablename." where idFactura='".$idFactura."'";
		$query = Executor::doit($sql);
		$found = null;
		$data = new FacturaData();
		while($r = $query[0]->fetch_array()){
			$data->idFactura = $r['idFactura'];
			$data->fecha = $r['fecha'];
			$data->idCliente = $r['idCliente'];
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
			$array[$cnt] = new FacturaData();
			$array[$cnt]->idFatura = $r['idFactura'];
                        $array[$cnt]->idFatura = isset($r['idFactura']) ? $r['idFactura'] : '';
                        $array[$cnt]->idCliente = $r['idCliente'];
						$array[$cnt]->fecha= $r['fecha'];
                        $cnt++;
		}
		return $array;
	}
}

?>