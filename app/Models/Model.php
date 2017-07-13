<?php

namespace App\Models;

use App\Config\Executor;

abstract class Model {
    public $id;
    public static $tablename;
    private static $aclass;

    abstract function add();
    abstract function update();

    public static function delById($id){
        $sql = "DELETE FROM ".self::$tablename." WHERE id = {$id}";
        Executor::doit($sql);
    }

    public function del(){
        $sql = "DELETE FROM ".self::$tablename." WHERE id = {$this->id}";
        Executor::doit($sql);
    }

    public static function getById($id){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id = {$id}";
        $query = Executor::doit($sql);

        return self::one($query[0]);
    }

    public static function getAll(){
        $sql = "SELECT * FROM ".self::$tablename;
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }

    public static function getRange($i, $q){
        $sql = "SELECT * FROM ".self::$tablename." LIMIT {$i}, {$q}";
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }

    public static function getSearch($field, $key){
        $sql = "SELECT * FROM ".self::$tablename." where {$field} LIKE '%{$key}%'  LIMIT 0, 25";
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }

    public static function getClassName(){
        return get_called_class();
    }

	public static function many($query){
        if (self::$aclass == '') self::$aclass = self::getClassName();
		$cnt = 0;
		$array = array();

		while($r = $query->fetch_array()){
			$array[$cnt] = new self::$aclass;
			$cnt2=1;
			foreach ($r as $key => $v) {
				if($cnt2>0 && $cnt2%2==0){
					$array[$cnt]->$key = $v;
				}
				$cnt2++;
			}
			$cnt++;
		}
		return $array;
	}

	public static function one($query){
        if (self::$aclass == '') self::$aclass = self::getClassName();
		$found = null;
		$data = new self::$aclass;

		while($r = $query->fetch_array()){
			$cnt=1;
			foreach ($r as $key => $v) {
				if($cnt>0 && $cnt%2==0){
					$data->$key = $v;
				}
				$cnt++;
			}

			$found = $data;
			break;
		}
		return $found;
	}
}