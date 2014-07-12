<?php

class Gomez_Autoload_StaticResolver extends Gomez_Autoload_BaseResolver {

    protected $map;

    public function __construct($map, $insensitive = false, $basepath = false) {
        $this->map = $map;
        parent::__construct($insensitive, $basepath);
    }

    protected function _resolve($classname) {
        return @$this->map[$classname];
    }

}
