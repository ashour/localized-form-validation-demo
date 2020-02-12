<?php
require_once dirname(__FILE__) . '/../i18n/I18n.php';

class Validator
{
    public static function make($rules, $fields)
    {
        return new static($rules, $fields);
    }

    private $rules;
    private $fields;
    private $errors = [];

    public function __construct($rules, $fields)
    {
        $this->rules = $rules;
        $this->fields = $fields;
    }

    public function isAllValid()
    {
        $this->errors = [];

        // We spin on each field's defined rules, calling each one reflectively.
        // We stop at the first rule for a field that _doesn't_ pass, if one
        // exists. And, if we have a failing rule for a field, we add it to our
        // errors array.
        foreach ($this->rules as $field => $rules) {
            $value = $this->fields[$field] ?? null;

            foreach ($rules as $rule) {
                // Some rules, like min(imum) length, have arguments. So
                // we parse each rule (min|6) to separate the name (min)
                // from the argument (6).
                [$ruleName, $ruleArg] = $this->parseRule($rule);

                $validateMethod = "validate_{$ruleName}";

                if (!$this->$validateMethod($value, $ruleArg)) {
                    $this->errors[$field] =
                        $this->getErrorText($field, $ruleName, $ruleArg);
                    break;
                }
            }
        }

        return count($this->errors) == 0;
    }

    public function errors()
    {
        return $this->errors;
    }

    private function parseRule($rule)
    {
        $parts = explode('|', trim($rule));

        $ruleName = $parts[0];

        $arg = count($parts) == 1 ? null : $parts[1];

        return [$ruleName, $arg];
    }

    private function getErrorText($field, $rule, $arg)
    {
        $key = I18n::hasKey("error_{$rule}_{$field}") ?
            "error_{$rule}_{$field}" : // error_required_first_name
            "error_{$rule}";           // error_required

        $translatedField = ucwords(I18n::__($field));

        return I18n::__($key, ['field' => $translatedField, 'arg' => $arg]);
    }

    private function validate_required($value)
    {
        return $value != null && strlen(trim($value)) > 0;
    }

    private function validate_email($value)
    {
        return !!filter_var(trim($value), FILTER_VALIDATE_EMAIL);
    }

    private function validate_min($value, $min)
    {
        return strlen(trim($value)) >= $min;
    }
}
