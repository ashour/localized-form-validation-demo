<?php
require_once 'FormControl.php';
require_once dirname(__FILE__) . '/../functions.php';

class Button extends FormControl
{
    public function __construct($name)
    {
        parent::__construct($name, null, null);
    }

    public function render()
    {
        $label = __($this->name);

        return <<<HTML
            <div class="field">
                <div class="control">
                    <button class="button is-link">
                        {$label}
                    </button>
                </div>
            </div>
HTML;
    }
}
