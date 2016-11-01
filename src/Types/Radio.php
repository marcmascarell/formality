<?php

namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Field\Field;

class Radio extends Field
{
    protected function input()
    {
        return Form::radio($this->name, $this->value, false, $this->attributes);
    }
}
