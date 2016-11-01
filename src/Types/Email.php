<?php

namespace Mascame\Formality\Types;

use Form;
use HTML;
use Input;
use Mascame\Formality\Field\Field;

class Email extends Field
{
    protected function input()
    {
        return Form::email($this->name, $this->value, $this->attributes);
    }

    public function show()
    {
        return HTML::mailto($this->value, $this->value);
    }
}
