<?php
namespace RobinTheHood\Tokenizer;

class Tokenizer
{
    private $definition;
    private $fileContent = '';
    private $fileLength = 0;
    private $filePointer = 0;
    private $state = 0;
    private $contextStack = ['default'];
    private $contextStackPointer = 0;

    public function __construct($filePath = '', $definitionPath = '')
    {
        if (file_exists($filePath)) {
            $this->fileContent = file_get_contents($filePath);
            $this->fileLength = strlen($this->fileContent);
        }

        if (file_exists($definitionPath)) {
            $this->definition = include $definitionPath;
        }
    }

    public function setContent($string)
    {
        $this->fileContent = $string;
        $this->fileLength = strlen($string);
    }

    public function getAllTokens()
    {
        $tokens = [];
        while($this->filePointer < $this->fileLength) {
            $tokens[] = $this->getNextToken();
        }
        return $tokens;
    }

    public function getNextToken()
    {
        $rules = $this->definition[$this->contextStack[$this->contextStackPointer]];
        $unknown = '';
        while ($this->filePointer < $this->fileLength) {
            $offestString = substr($this->fileContent, $this->filePointer);
            $elements = $this->getElements($rules, $offestString);
            $element = $this->selectElementByLongestMatch($elements);

            if ($element) {
                if ($unknown) {
                    return new Token('T_UNKNOWN', $unknown, $this->filePointer);
                }

                if (isset($element['rule']['context'])) {
                    if ($element['rule']['context'] == '_back' ) {
                        $this->contextStackPointer--;
                    } else if ($element['rule']['context']) {
                        $this->contextStack[++$this->contextStackPointer] = $element['rule']['context'];
                    }
                }

                $matchIndex = 0;
                $this->filePointer += strlen($element['matches'][$matchIndex][0]);
                return new Token($element['rule']['name'], $element['matches'][$matchIndex][0], $this->filePointer);
            }

            $char = substr($this->fileContent, $this->filePointer, 1);
            $unknown .= $char;
            $this->filePointer++;
        }
        if ($unknown) {
            return new Token('T_UNKNOWN', $unknown, $this->filePointer);
        }
    }

    public function getElements($rules, $string)
    {
        $elements = [];
        foreach ($rules as $rule) {
            preg_match('/^' . $rule['regex'] . '/', $string, $matches, PREG_OFFSET_CAPTURE, 0);
            if ($matches) {
                $elements[] = [
                    'rule' => $rule,
                    'matches' => $matches
                ];
            }
        }
        return $elements;
    }

    public function selectElementByLongestMatch($elements)
    {
        $matchIndex = 0;
        $maxLength = 0;
        $selectedElement = null;
        foreach($elements as $element) {
            $length = strlen($element['matches'][$matchIndex][0]);
            if ($length > $maxLength) {
                $selectedElement = $element;
                $maxLength = $length;
            }
        }
        return $selectedElement;
    }
}
