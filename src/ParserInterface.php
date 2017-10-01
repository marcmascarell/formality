<?php

namespace Mascame\Formality;

interface ParserInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function parse($name);

    /**
     * @return array
     */
    public function getTypeReasons();
}
