<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Field\Field;

class Select extends Field
{

    protected function input()
    {
        return Form::select($this->name, $this->value, false, $this->attributes);
    }

    public function outputRange($start, $end)
    {
        return Form::selectRange($this->name, $start, $end);
    }

    public function outputMonth()
    {
        return Form::selectMonth($this->name);
    }

    public function outputYear()
    {
        return Form::selectYear($this->name);
    }
}