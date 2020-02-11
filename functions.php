<?php
require_once dirname(__FILE__) . '/i18n/I18n.php';

function __($key, $replacements = [])
{
    return I18n::__($key, $replacements);
}
