# Tokenizer


![alt text](https://raw.githubusercontent.com/RobinTheHood/Tokenizer/master/docs/Example-Image.png)


## About

With Tokenizer you can easily convert a string to a stream or array of tokens. You can use it for syntax highlighting or a syntax parser. If you wish more features feel free to contribute.

## Installation


If Composer is installed globally, run

```bash
composer require robinthehood/tokenizer
```

## How to use

### Code
```php
require 'vendor/autoload.php'; // if you are using Composer

$tokenizer = new RobinTheHood\Tokenizer\Tokenizer(__FILE__, 'token_php.php');
$tokens = $tokenizer->getAllTokens();
print_r($tokens);
```

### Result

You get an array of token objects:
```
Array
(
    [0] => Tokenizer\Token Object
        (
            [type] => T_UNKNOWN
            [value] => <?
            [position] => 2
        )

    [1] => Tokenizer\Token Object
        (
            [type] => T_IDENT
            [value] => php
            [position] => 5
        )

    [2] => Tokenizer\Token Object
        (
            [type] => T_UNKNOWN
            [value] =>

            [position] => 6
        )

    [3] => Tokenizer\Token Object
        (
            [type] => T_COMMENT
            [value] => /*
            [position] => 8
        )

    [...]
```

## Parameters

new Tokenizer(FILE_PATH, DESCRIPTION_FILE_PATH)

FILE_PATH:  
Is the File you want to spilt into tokens

DESCRIPTION_FILE_PATH:  
Is a file with a array-structure including regular expressions to define tokens. You can find a example description file to define the basic tokens of the php-syntax in examples/token_php.php.

# License
Copyright (c) 2017 Robin Wieschendorf

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
