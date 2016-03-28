<?php namespace Mascame\Formality\Parser;

use \Illuminate\Support\Str as Str;

interface ParserInterface
{
    /**
     * @param $field
     * @return bool|int|mixed|string
     */
    public function parse($field);

    /**
     * @return array
     */
    public function getTypeReasons();
}