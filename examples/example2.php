<?php
/*
Run this file on the console with:
> php examples2.php
*/
require_once '../vendor/autoload.php';

use Tokenizer\Tokenizer;
use Terminal\Terminal;

if (!class_exists('Terminal\Terminal')) {
    echo "*** For this example you have to install 'robinthehood/terminal' ***\n";
    echo "\n";
    echo "    composer require robinthehood/terminal\n";
    echo "\n";
    die();
}

$tokenizer = new Tokenizer(__FILE__, 'token_php.php');
$tokens = $tokenizer->getAllTokens();
printColored($tokens);

/*Do syntax highlighting*/

function printColored($tokens)
{
    $terminal = new Terminal();
    $terminal->setLineNumbersEnabled(true);

    foreach($tokens as $token) {
        if ($token->type == 'T_VARIABLE') {
            $terminal->setColor(Terminal::RED);
        } else if ($token->type == 'T_REF_VARIABLE') {
            $terminal->setColor(Terminal::RED);
        } else if ($token->type == 'T_KEYWORD') {
            $terminal->setColor(Terminal::BLUE);
        } else if ($token->type == 'T_STRING') {
            $terminal->setColor(Terminal::GREEN);
        } else if ($token->type == 'T_STRING_ESCAPE') {
            $terminal->setColor(Terminal::LIGHT_BLUE);
        } else if ($token->type == 'T_IDENT') {
            $terminal->setColor(Terminal::YELLOW);
        } else if ($token->type == 'T_CLASSNAME') {
            $terminal->setColor(Terminal::LIGHT_YELLOW);
        } else if ($token->type == 'T_COMMENT') {
            $terminal->setColor(Terminal::BLACK);
        } else if ($token->type == 'T_NUMBER') {
            $terminal->setColor(Terminal::MAGENTA);
        } else if ($token->type == 'T_FUNCTION_CALL') {
            $terminal->setColor(Terminal::LIGHT_CYAN);
        } else {
            $terminal->setColor(Terminal::WHITE);
        }
        $terminal->out($token->value);
    }
}
