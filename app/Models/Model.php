<?php

namespace App\Models;

use App\Config\Executor;

/**
 * Class Model - Clase generica para generar consultas a la base de datos
 * @package App\Models
 */
abstract class Model {
    /**
     * @var $schema - Nombre del esquema al que pertenece la tabla, or defecto es publico
     */
    protected static $schema = 'public';
    
    /**
     * @var $tablename - Nombre de la tabla que ocupara el modelo, se declara de manera estatica para que todos los metodos puedan acceder a ella
     */
    protected static $tablename;
    
    /**
     * @var $idField - Nombre del campo con clave primaria, sirve para hacer los dedById, getById, update, etc...
     */
    protected static $idField = 'id';
    
    protected static $tmarks = (DB_DRIVER == 'pgsql') ? '"' : '`';
    protected static $fmarks = (DB_DRIVER == 'pgsql') ? '\'' : '\'';
    
    public function add(){
        try {
            $sql = "INSERT INTO " . self::getTable() . "(" . $this->getParams(3) . ")
            VALUES (" . $this->getParams() . ")";
            
            return $this->executeSQL($sql);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    public function update(){
        try {
            $sql = "UPDATE " . self::getTable()  . " SET " . $this->getParams(2) . " WHERE " . self::getPK() . " = :" . static::$idField;
            
            return $this->executeSQL($sql);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    public static function delById($id){
        try {
            $sql = "DELETE FROM " . self::getTable()  . " WHERE " . static::getPK() . " = {$id}";
            return Executor::doit($sql);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    public function del(){
        try {
            $sql = "DELETE FROM " . self::getTable() . " WHERE " . static::getPK() . " = :".static::$idField;
            return $this->executeSQL($sql);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    public static function getById($id){
        try {
            if (!empty($id)) {
                $sql = "SELECT * FROM " . self::getTable() . " WHERE " . static::getPK() . " = {$id}";
                $query = Executor::doit($sql);
                
                return self::one($query);
            } else
                return array();
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    public static function getAll($cond = '', $ord = '', $i = null, $q = null){
        try {
            $sql = "SELECT * FROM ".self::getTable().(empty($cond) ? '' : " WHERE {$cond}").(empty($ord) ? '' : " ORDER BY ".$ord).
                (($i !== 0 && empty($i)) ? '' : " LIMIT {$i}").(empty($q) ? '' : ", {$q}");
            $query = Executor::doit($sql);
            
            return self::many($query);
        } catch (\Exception $e){
            echo $sql;
            throw new \Exception($e->getMessage());
        }
    }
    
    public static function getSearch($field, $key, $ord = '', $i = null, $q = null){
        try {
            $sql = "SELECT * FROM ".self::getTable()." WHERE ".self::getField($field)." LIKE '%{$key}%'".(empty($ord) ? '' : " ORDER BY ".self::getField($ord)).
                (empty($i) ? '' : " LIMIT {$i}").(empty($q) ? '' : ", {$q}");
            $query = Executor::doit($sql);
            
            return self::many($query);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    public static function getNumRows($cond = ''){
        try {
            $sql = "SELECT * FROM ".self::getTable().(empty($cond) ? '' : " WHERE {$cond}");
            $n = Executor::doit($sql, [], true);
            
            return $n;
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    public static function getClassName(){
        return get_called_class();
    }
    
    protected static function many($query, $aclass = ''){
        if($aclass == '')
            $aclass = self::getClassName();
        
        $cnt = 0;
        $array = array();
        
        foreach($query as $q){
            $array[$cnt] = new $aclass;
            
            $cnt2 = 1;
            foreach ($q as $key => $v) {
                $array[$cnt]->$key = $v;
                $cnt2++;
            }
            $cnt++;
        }
        
        return $array;
    }
    
    protected static function one($query, $aclass = ''){
        if($aclass == '')
            $aclass = self::getClassName();
        
        $found = null;
        $data = new $aclass;
        
        foreach ($query as $q){
            $cnt = 1;
            foreach ($q as $key => $v) {
                $data->$key = $v;
                $cnt++;
            }
            
            $found = $data;
            break;
        }
        return $found;
    }
    
    private function getProperties(){
        return (array)$this;
    }
    
    /**
     * @param $sql - Consulta en sql
     * @param array $val - Array con los parametros, si va vacio manda los valores del objeto
     * @return array|void - Arreglo con [0]Resultao de la consulta y [1]Ultimo ID insertado si el driver lo soporta
     */
    private function executeSQL($sql, $val = []){
        try {
            return Executor::doit($sql, (count($val) == 0) ? $this->getProperties() : $val);
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    /**
     * @desc Genera la lista de parametros para las consultas
     * @param int $mode
     *      1 .- Listado de parametros dividido por comas
     *      2 .- Listado con asignacion de campo a parametro
     * @return string - Listado de parametros
     */
    private function getParams($mode = 1){
        $properties = '';
        foreach ($this->getProperties() as $p => $v)
            if ($mode == 1)
                $properties .= ((!empty($v) || $v == 0) && $p != static::$idField)
                    ? ':' . $p . ', '
                    : '';
            elseif ($mode == 2)
                $properties .= ((!empty($v) || $v == 0) && $p != static::$idField)
                    ? self::getField($p) . ' = :' . $p . ', '
                    : '';
            else
                $properties .= ((!empty($v) || $v == 0) && $p != static::$idField)
                    ? self::getField($p) . ', '
                    : '';
        
        return trim($properties, ', ');
    }
    
    protected static function getTable(){
        if (DB_DRIVER == 'pgsql')
            return self::$tmarks . static::$schema . self::$tmarks. '.' . self::$tmarks . static::$tablename . self::$tmarks;
        else
            return self::$tmarks . static::$tablename . self::$tmarks;
    }
    
    protected static function getPK(){
        return self::$tmarks . static::$idField . self::$tmarks;
    }
    
    protected static function getField($f){
        return self::$tmarks . $f . self::$tmarks;
    }
}