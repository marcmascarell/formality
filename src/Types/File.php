<?php

namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Field\Field;

class File extends Field
{
    protected function input()
    {
        return Form::file($this->name);
    }
}
