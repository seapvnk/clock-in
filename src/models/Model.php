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
        return $this->values[$key]?? null;
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }

    public function load($arr)
    {
        if ($arr) {
            foreach ($arr as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public static function all($filters = [], $columns = '*')
    {
        $objects = [];
        $result = static::select($filters);

        if ($result) {
            $class = get_called_class();
            while ($row = $result->fetch_assoc()) {
                array_push($objects, new $class($row));
            }
        }
        
        return $objects;
    }

    public static function one($filters = [], $columns = '*')
    {
        $class = get_called_class();
        $result =  static::select($filters, $columns);
        return $result? new $class($result->fetch_assoc()) : null;
    }

    public static function select($filters = [], $columns = '*')
    {
        $sql = "SELECT $columns FROM "
                . static::$table . " "
                . static::filters($filters);

        $result = Database::query($sql);

        return $result;
    }

    public function insert()
    {
        $sql = "INSERT INTO " . static::$table .  " ("
               . implode(",", static::$columns) . " ) VALUES (";
        
        foreach (static::$columns as $column) {
            $sql .= static::format($this->$column) . ",";
        }

        $sql[strlen($sql) - 1] = ')';
        $id = Database::execute($sql);
        
        $this->id = $id; 

    }

    public function update()
    {
        $sql = "UPDATE " . static::$table . " SET ";
        foreach (static::$columns as $column) {
            $sql .= " ${column} = " . static::format($this->$column) . ",";
        }

        $sql[strlen($sql) - 1] = ' ';
        $sql .= "WHERE id = {$this->id}";

        Database::execute($sql);
    }


    private static function filters($filters)
    {
        $sql = '';
        if (count($filters) > 0) {
            $sql .= "WHERE 1 = 1";

            foreach($filters as $column => $value) {
                $sql .= " AND ${column} = " . static::format($value);
            }
        }
        
        return $sql;
    }

    private static function format($value)
    {
        if (is_null($value)) {
            return "null";
        } elseif (is_string($value)) {
            return "'${value}'";
        }
        
        return $value;
    }

}