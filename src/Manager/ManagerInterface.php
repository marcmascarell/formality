<?php namespace Mascame\Formality\Manager;

use Mascame\Formality\Parser\ParserInterface;

interface ManagerInterface
{
    /**
     * @return ParserInterface
     */
    public function getParser();

    public function getFieldClass();
}