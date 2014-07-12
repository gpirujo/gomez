<?php

class Gomez_Autoload_CompositeResolver implements Gomez_Autoload_Resolver {

    protected $resolvers = array();

    public function __construct($resolvers = array()) {
        foreach ($resolvers as $resolver) {
            $this->addResolver($resolver);
        }
    }

    public function addResolver(Gomez_Autoload_Resolver $resolver) {
        $this->resolvers[] = $resolver;
    }

    public function resolve($classname) {
        foreach ($this->resolvers as $resolver) {
            if ($filename = $resolver->resolve($classname)) {
                return $filename;
            }
        }
        return false;
    }

}
