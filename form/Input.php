<?php
require_once 'FormControl.php';
require_once dirname(__FILE__) . '/../functions.php';

class Input extends FormControl
{
    public function __construct($name, $errors, $type = 'text')
    {
        parent::__construct($name, $errors, $type);
    }

    public function render()
    {
        $name = $this->name;
        $label = __($this->name);
        $type = $this->type;
        $value = $_REQUEST[$this->name] ?? null;
        $inputClasses = $this->inputClasses();
        $errorClasses = $this->errorClasses();
        $errorText = $this->errors[$this->name] ?? null;

        return <<<HTML
            <div class="field">
                <label class="label" for="{$name}">{$label}</label>

                <div class="control">
                    <input
                        id="{$name}"
                        name="{$name}"
                        type="{$type}"
                        value="{$value}"
                        class="{$inputClasses}"
                    >
                </div>

                <p class="{$errorClasses}">{$errorText}</p>
            </div>
HTML;
    }
}
