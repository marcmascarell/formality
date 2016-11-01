<?php

namespace Mascame\Formality\Types;

use Form;

class Enum extends Select
{
    protected function input()
    {
        $values = $this->field->getOption('values', []);

        return Form::select($this->name, $values, $this->value, $this->attributes);
    }
}
