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

    public function load($arr)
    {
        if ($arr) {
            foreach ($arr as $key => $value) {
                $this->$key=  $value;
            }
        }
    }

    public function __get($key)
    {
        return $this->values[$key];
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }
}