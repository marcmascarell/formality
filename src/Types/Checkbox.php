<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Field\Field;

class Checkbox extends Field
{

    protected function input()
    {
        print Form::hidden($this->name, 0);
        print Form::checkbox($this->name, 1, $this->value, $this->attributes);
    }

}