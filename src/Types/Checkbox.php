<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Type\Type;

class Checkbox extends Type
{

    protected function input()
    {
        print Form::hidden($this->name, 0);
        print Form::checkbox($this->name, 1, $this->value, $this->attributes);
    }

}