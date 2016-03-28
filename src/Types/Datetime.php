<?php namespace Mascame\Formality\Types;

use Carbon\Carbon;
use Form;
use Mascame\Formality\Type\Type;

class DateTime extends Type
{

    protected function input()
    {
        ?>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <?php print Form::text($this->name, $this->value, $this->attributes); ?>
        </div>
    <?php
    }

    public function show()
    {
        $date = Carbon::parse($this->value);

        // Todo: dont make this specific
        return $date->format('d-m-Y H:i:s');
    }

}