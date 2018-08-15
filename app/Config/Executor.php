<?php

namespace App\Config;

use PDO;
use Exception;

class Executor {
    public static function doit($sql, $values = [], $is_counter = false){
        $con = DB::getCon();
        try {
            $query = $con->prepare($sql);
            
            if (count($values) > 0) {
                foreach ($values as $property => $val) {
                    $type = null;
                    if ((!empty($val) || $val == 0) && strpos($sql, ':' . $property)) {
                        if (is_int($val))
                            $type = PDO::PARAM_INT;
                        elseif (is_bool($val))
                            $type = PDO::PARAM_BOOL;
                        else
                            $type = PDO::PARAM_STR;
                        
                        $query->bindValue(':' . $property, $val, $type);
                    }
                }
            }
            
            $query->execute();
            if ($is_counter)
                return $query->rowCount();
            else {
                if (explode(' ', $sql)[0] == 'SELECT') {
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } elseif (explode(' ', $sql)[0] == 'INSERT') {
                    if (DB_DRIVER == 'odbc')
                        return 0;
                    else
                        return $con->lastInsertId();
                } else {
                    return 1;
                }
            }
        } catch (Exception $e){
            throw new Exception('<b>' . $e->getCode() . '</b>: ' . $e->getMessage());
        }
    }
}