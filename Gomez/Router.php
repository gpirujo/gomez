<?php

class Gomez_Router {

    protected $rules;
    protected $default;
    protected $options;

    public function __construct(array $rules = array(), $default = null, array $options = array()) {
        $this->rules = $rules;
        $this->default = $default;
        $this->options = $options;
    }

    public function run($request_uri) {

        if (isset($this->options['uri_prefix'])) {
            $uri_prefix = $this->options['uri_prefix'];
            $prefix_len = strlen($uri_prefix);
            if (substr($request_uri, 0, $prefix_len) == $uri_prefix) {
                $request_uri = substr($request_uri, $prefix_len);
            }
        }

        foreach ($this->rules as $match => $response) {
            if (preg_match($match, $request_uri)) {
                return $response;
            }
        }

        return $this->default;

    }

}
