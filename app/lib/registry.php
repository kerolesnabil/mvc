<?php

namespace PHPMVC\Lib;

class Registry
{

    private static $_instance;
    private $_session;

    private function __construct($session)
    {
        $this->_session = $session;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance(SessionManager $session){
        if(self::$_instance=== null){
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    public function __set($key, $object)
    {
        $this->{$key} = $object;
    }

    public function __get($key)
    {
        return $this->{$key};
    }

}