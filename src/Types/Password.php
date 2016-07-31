<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Field\Field;

class Password extends Field
{

    protected function input()
    {
        return Form::password($this->name, $this->attributes);
    }

    public function show()
    {
        return 'hidden';
    }

}