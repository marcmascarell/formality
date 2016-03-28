<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Type\Type;

class File extends Type
{

    protected function input()
    {
        return Form::file($this->name);
    }

}