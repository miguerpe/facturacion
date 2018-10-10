<?php
class Database {
	public static $db;
	public static $con;
	function __construct(){
		$this->user="root";$this->pass="";$this->host="localhost";$this->ddbb="facturacion";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
        
        public function getDump($ruta){
            $dump = "mysqldump --result-file=$ruta --default-character-set=utf8 --no-create-info --add-locks=FALSE --disable-keys=FALSE --extended-insert --user=$this->user --password=$this->pass $this->ddbb";
            $a = system($dump,$retval);
            return $a;
        }
	
}
?>
