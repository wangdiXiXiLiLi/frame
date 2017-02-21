<?php
namespace core;
use core\Config;
use PDO;

class Model{

	protected $dbagent;
	protected $table;

	function __construct($tablename = ''){
		try{
			$this->dbagent=new PDO('mysql:host='.Config::get('db_host').';dbname='.Config::get('db_name').';charset='.Config::get('db_charset'),Config::get('db_user'),Config::get('db_pwd'));
		}catch(PDOException $e) {
    		echo 'Connection failed: ' . $e->getMessage();
		}
		$this->table = Config::get('db_table_prefix').$tablename;
	}

//获得表所有的列
	public function COLUMNS()
	{

		$sql="SHOW Columns from `".$this->table."`";
		$pdo=$this->dbagent->query($sql);	//执行
		$result = $pdo->fetchAll(PDO::FETCH_ASSOC);		
		$info = [];
			if($result){
				foreach ($result as $key => $val) {
					$val = array_change_key_case($val);
					$info[$val['field']] = [
					  'name' => $val['field'],
					  'type' => $val['type'],
					  'notnull' => (bool)('' === $val['null']),
					  'default' => $val['default'],
					  'primary' => (strtolower($val['key']) == 'pri'),
					  'auto' => (strtolower($val['extra']) == 'auto_increment'),
					];
			}
		return $info;
		}
	}


//查询一个表

	public function SELECT($fields=[],$where=[],$order=null,$limit=null,$size=null){
		$sql = "select ";
		if(!empty($fields)){
			if(is_array($fields)){
				$fieldslist=implode(',', $fields);
				$sql.="$fieldslist ";
			}
		}else{
			$sql.="* ";
		}

		$sql.="from ".$this->table." ";

		if(!empty())

	}




}
?>