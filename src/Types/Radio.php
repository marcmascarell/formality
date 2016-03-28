<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Type\Type;

class Radio extends Type
{

    protected function input()
    {
        return Form::radio($this->name, $this->value, false, $this->attributes);
    }

}