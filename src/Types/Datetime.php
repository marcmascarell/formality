<?php

namespace Mascame\Formality\Types;

use Carbon\Carbon;
use Form;
use Mascame\Formality\Field\Field;

class Datetime extends Field
{
    protected function input()
    {
        return Form::text($this->name, $this->value, $this->attributes);
    }

    public function show()
    {
        $date = Carbon::parse($this->value);

        // Todo: dont make this specific
        return $date->format('d-m-Y H:i:s');
    }
}
