<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Type\Type;

class Text extends Type
{

    protected function input()
    {
        return Form::text($this->name, $this->value, $this->attributes);
    }

}