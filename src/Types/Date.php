<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Type\Type;

class Date extends Type
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

}