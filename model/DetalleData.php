<?php
class DetalleData {
	public static $tablename = "detalleFactura";

	public function __construct(){
                $this->fecha = getdate();
	}

	public function agregar(){
		$sql = "insert into ".self::$tablename." (idFactura,idItem,detalle,cantidad, valorUnitario) ";
		$sql .= "values ($this->idFactura,$this->idItem,'$this->detalle',$this->cantidad,$this->valorUnitario )";
		echo "<script>alert('".$sql."');</script>";
		return Executor::doit($sql);
	}

	public static function eliminarPorIdDetalle($idDetalle){
		$sql = "delete from ".self::$tablename." where idDetalle=$nickname";
		Executor::doit($sql);
	}
	public function eliminar(){
		$sql = "delete from ".self::$tablename." where idDetalle=$this->idDetalle";
		Executor::doit($sql);
	}

	public static function getId($idDetalle){
		$sql = "select * from ".self::$tablename." where idFactura='".$idFactura."'";
		$query = Executor::doit($sql);
		$found = null;
		$data = new DetalleData();
		while($r = $query[0]->fetch_array()){
			$data->idItem = $r['idFactura'];
			$data->idFactura = $r['fecha'];
			$data->detalle = $r['icCliente'];
			$data->valorUnitario= $r['icCliente'];
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
			$array[$cnt] = new DetalleData();
			$array[$cnt]->idFatura = $r['idFactura'];
                        $array[$cnt]->idItem = isset($r['idItem']) ? $r['idItem'] : '';
                        $array[$cnt]->idDetalle = $r['idDetalle'];
						$array[$cnt]->cantidad= $r['cantidad'];
						$array[$cnt]->valorUnitario= $r['valorUnitario'];
                        $cnt++;
		}
		return $array;
	}
}

?>