<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Type\Type;

class Color extends Type
{

    protected function input()
    {
        print Form::input('color', $this->name, $this->value, $this->attributes);
    }

}