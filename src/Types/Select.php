<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Type\Type;

class Select extends Type
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