<?php

namespace Mascame\Formality\Parser;

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
