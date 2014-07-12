<?php

class Gomez_Autoload_CachingResolver implements Gomez_Autoload_Resolver {

    protected $resolver;
    protected $template;

    public function __construct(Gomez_Autoload_Resolver $resolver, $template = 'AutoloadCache-%s') {
        $this->resolver = $resolver;
        $this->template = $template;
    }

    public function resolve($classname) {
        $key = sprintf($this->template, $classname);
        $filename = apc_fetch($key);
        if (!$filename) {
            $filename = $this->resolver->resolve($classname);
            apc_add($key, $filename);
        }
        return $filename;
    }

}
