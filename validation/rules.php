<?php
$rules = [
    'name' => ['required'],
    'email' => ['required', 'email'],
    'password' => ['required', 'min|6'],
    'agree_to_terms' => ['required'],
];
