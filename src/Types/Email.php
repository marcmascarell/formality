<?php namespace Mascame\Formality\Types;

use Form;
use HTML;
use Input;
use Mascame\Formality\Type\Type;

class Email extends Type
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