<?php namespace Mascame\Formality\Types;

use Form;
use Mascame\Formality\Field\Field;

class Date extends Field
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