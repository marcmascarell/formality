<?php namespace Mascame\Formality\Manager;


use Mascame\Formality\Parser\ParserInterface;

class Manager implements ManagerInterface
{
    /**
     * @var ParserInterface
     */
    public $parser;

    /**
     * @var string
     */
    public $fieldClass = '\Mascame\Formality\Field\Field\\';

    public function __construct(ParserInterface $parser, $fieldClass = null)
    {
        $this->parser = $parser;

        if ($fieldClass) $this->fieldClass = $fieldClass;
    }

    public function getParser()
    {
        return $this->parser;
    }

    public function getFieldClass()
    {
        return $this->fieldClass;
    }


}