<?php

namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Field\Field;

class Color extends Field
{
    protected function input()
    {
        return Form::input('color', $this->name, $this->value, $this->attributes);
    }
}
