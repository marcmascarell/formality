<?php

namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Field\Field;

class Date extends Field
{
    protected function input()
    {
        return Form::text($this->name, $this->value, $this->attributes);
    }
}
