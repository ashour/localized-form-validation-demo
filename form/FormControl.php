<?php
require_once dirname(__FILE__) . '/../functions.php';

abstract class FormControl
{
    public static function make($name, $errors = null, $type = null)
    {
        return new static($name, $errors, $type);
    }

    protected $name;
    protected $type;
    protected $errors;

    public function __construct($name, $errors, $type)
    {
        $this->name = $name;
        $this->type = $type;
        $this->errors = $errors;
    }

    abstract function render();

    protected function inputClasses($defaultClass = 'input')
    {
        $classes = [$defaultClass];

        if (isset($this->errors[$this->name])) {
            $classes[] = 'is-danger';
        }

        return implode(' ', $classes);
    }

    protected function errorClasses($defaultClass = 'help is-danger')
    {
        $classes = [$defaultClass, "error-for-{$this->name}"];

        if (!isset($this->errors[$this->name])) {
            $classes[] = 'is-hidden';
        }

        return implode(' ', $classes);
    }
}
