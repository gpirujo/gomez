<?php

abstract class Gomez_Autoload_BaseResolver implements Gomez_Autoload_Resolver {

    protected $insensitive;
    protected $basepath;

    public function __construct($insensitive = false, $basepath = false) {
        $this->insensitive = (bool) $insensitive;
        if (!$basepath) {
            $basepath = $_SERVER['DOCUMENT_ROOT'];
        }
        $this->basepath = $basepath;
    }

    protected function qualify($filename) {
        return $this->basepath . $filename;
    }

    public function resolve($classname) {
        if ($this->insensitive) {
            $classname = strtolower($classname);
        }
        if ($filename = $this->_resolve($classname)) {
            return $this->qualify($filename);
        }
        return false;
    }

    protected function _resolve($classname) {
        return false;
    }

}
