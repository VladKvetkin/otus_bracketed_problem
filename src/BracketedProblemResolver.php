<?php

class BracketedProblemResolver
{
    /** @var string Bracketed problem string */
    private $bracketedString;

    private const VALID_SYMBOLS = array('(', ')', ' ', "\n", "\t", "\r");

    public function __construct(string $bracketedString)
    {
        $this->bracketedString = $bracketedString;
    }

    /**
     * Resolve bracketed string problem
     * @return bool bracketedString resolve result
     */
    public function resolve(): bool
    {
        $bracketedArray = str_split($this->bracketedString);
        if (empty($bracketedArray)) {
            return true;
        }

        if (count($bracketedArray) !== count(array_intersect($bracketedArray, self::VALID_SYMBOLS))) {
            throw new InvalidArgumentException('Input string has invalid symbols');
        }

        $openBracketStack = array();
        foreach ($bracketedArray as $bracketSymbol) {
            if (empty($openBracketStack) && $bracketSymbol === ')') {
                return false;
            }

            if ($bracketSymbol === '(') {
                $openBracketStack[] = '(';
            } elseif ($bracketSymbol === ')') {
                array_shift($openBracketStack);
            }
        }

        return empty($openBracketStack);
    }
}