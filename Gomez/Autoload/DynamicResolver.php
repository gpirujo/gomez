<?php

class Gomez_Autoload_DynamicResolver extends Gomez_Autoload_BaseResolver {

    protected $paths;
    protected $templates;

    public function __construct($paths, $templates, $insensitive = false, $basepath = false) {
        $this->paths = $paths;
        $this->templates = $templates;
        parent::__construct($insensitive, $basepath);
    }

    protected function _resolve($classname) {
        $filename = preg_replace('/(\w)_/', '$1/', $classname);
        $dirname = dirname($filename);
        $basename = basename($filename);
        foreach ($this->paths as $path) {
            foreach ($this->templates as $template) {
                $filename = implode(DIRECTORY_SEPARATOR, array($path, $dirname, sprintf($template, $basename)));
                if (realpath($this->qualify($filename))) {
                    return $filename;
                }
            }
        }
        return false;
    }

}
