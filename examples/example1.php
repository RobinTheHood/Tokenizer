<?php
/*
Run this file on the console with:
> php examples1.php
*/
require_once '../vendor/autoload.php';

$tokenizer = new RobinTheHood\Tokenizer\Tokenizer(__FILE__, 'token_php.php');
$tokens = $tokenizer->getAllTokens();
print_r($tokens);
