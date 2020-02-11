<?php
require_once 'FormControl.php';
require_once dirname(__FILE__) . '/../functions.php';

class Checkbox extends FormControl
{
    public function __construct($name, $errors)
    {
        parent::__construct($name, $errors, 'checkbox');
    }

    public function render()
    {
        $name = $this->name;
        $label = __($this->name);

        $inputClasses = $this->inputClasses('checkbox');

        $checkedAttr = isset($_REQUEST[$this->name]) ? 'checked' : '';

        $errorClasses = $this->errorClasses();
        $errorText = @$this->errors[$this->name];

        return <<<HTML
            <div class="field">
                <div class="control">
                    <label class="{$inputClasses}">
                        <input type="checkbox" name="{$name}" {$checkedAttr}>

                        {$label}
                    </label>

                    <p class="{$errorClasses}">{$errorText}</p>
                </div>
            </div>
HTML;
    }
}
