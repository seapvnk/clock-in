<?php

class Model
{
    protected static $table = '';
    protected static $columns = [];
    protected $values = [];

    function __construct($arr)
    {
        $this->load($arr);
    }

    public function __get($key)
    {
        return $this->values[$key];
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }

    public function load($arr)
    {
        if ($arr) {
            foreach ($arr as $key => $value) {
                $this->$key=  $value;
            }
        }
    }

    public static function select($filters = [], $columns = '*')
    {
        $sql = "SELECT $columns FROM "
                . static::$table
                . ;
        return $sql;
    }

    private static function filters($filters)
    {
        $sql = '';
        if (count($filters) > 0) {
            $sql .= "WHERE 1 = 1";

            foreach($filters as $column => $value) {
                $sql .= " AND ${column} = " . static::getFormatedValue($value);
            }
        }
        return $sql;
    }

    private static function getFormatedValue($value)
    {
        if (is_null($value)) {
            return "null";
        } elseif (is_string($value)) {
            return "'${value}'";
        }
        
        return $value;
    }

}