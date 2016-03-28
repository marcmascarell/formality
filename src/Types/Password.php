<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Type\Type;

class Password extends Type
{

    protected function input()
    {
        return Form::password($this->name, $this->attributes);
    }

    public function show()
    {
        return $this->hidden();
    }

}