<?php

class Gomez_Autoload {

    protected $resolver;

    public function __construct(Gomez_Autoload_Resolver $resolver) {
        $this->setResolver($resolver);
        spl_autoload_register(array($this, 'load'));
    }

    public function setResolver(Gomez_Autoload_Resolver $resolver) {
        $this->resolver = $resolver;
    }

    public function getResolver() {
        return $this->resolver;
    }

    public function load($classname) {
        if ($filename = $this->getResolver()->resolve($classname)) {
            require $filename;
            return true;
        }
        return false;
    }

}
