<?php

namespace Mascame\Formality\Types;

use Form;

class Textarea extends Text
{
    protected function input()
    {
        return Form::textarea($this->name, $this->value, $this->attributes);
    }
}
