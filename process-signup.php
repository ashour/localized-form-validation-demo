<?php
require_once 'functions.php';
require_once 'validation/rules.php';
require_once 'validation/Validator.php';

$validator = Validator::make($rules, $_POST);

if ($validator->isAllValid()) {
    header('Location: /thank-you.php?lang=' . lang());
    die();
} else {
    $errors = $validator->errors();
    require_once 'index.php';
}
