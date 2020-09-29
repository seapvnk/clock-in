<?php

class Model
{
    protected static $table = '';
    protected static $columns = [];
    protected $values = [];

    function __construct($arr, $sanitize = true)
    {
        $this->load($arr, $sanitize);
    }

    public function __get($key)
    {
        return $this->values[$key]?? null;
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function load($arr, $sanitize = true)
    {
        if ($arr) {
            $conn = Database::getConnection();
            foreach ($arr as $key => $value) {
                $cleanValue = $value;

                if($sanitize && $cleanValue) {
                    $cleanValue = strip_tags(trim($cleanValue));
                    $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES);
                    $cleanValue = mysqli_real_escape_string($conn, $cleanValue);
                }

                $this->$key = $cleanValue;
            }
            $conn->close();

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

    public function count($filters = [])
    {
        $result = static::select($filters, 'COUNT(*) AS COUNT');
        return $result->fetch_assoc()['COUNT'];
    }


    private static function filters($filters)
    {
        $sql = '';
        if (count($filters) > 0) {
            $sql .= "WHERE 1 = 1";

            foreach($filters as $column => $value) {
                if ($column == 'raw') {
                    $sql .= " AND ${value}";

                } else {
                    $sql .= " AND ${column} = " . static::format($value);

                }
            }
        }
        
        return $sql;
    }

    public function delete()
    {
        self::deleteById($this->id);
    }

    public static function deleteById($id)
    {
        $sql = "DELETE FROM " . static::$table . " WHERE id = '{$id}'";
        Database::execute($sql);
    }

    private static function format($value)
    {
        if (is_null($value)) {
            return "null";
        } elseif (is_string($value)) {
            return "'{$value}'";
        }
        
        return $value;
    }

}