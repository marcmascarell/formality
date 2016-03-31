<?php namespace Mascame\Formality\Field;

use App;
use Illuminate\Support\Str;
use Mascame\Formality\Field\AbstractField;
use Mascame\Formality\Field\FieldInterface;

class Field extends AbstractField implements TypeInterface
{

    /**
     * @var string
     */
    public $type;

    /**
     * Type constructor.
     * @param string $type
     */
    public function __construct($name, $value = null, $options = [])
    {
        $this->name = $name;
        $this->value = ($value) ? $value : $this->getOption('default');
        $this->options = $options;

        $this->title = $this->getTitle();
        $this->wiki = $this->getOption('wiki');
        $this->attributes = $this->getOption('attributes');
        $this->type = $this->getType();
    }


    /**
     * @return mixed
     */
    public function show()
    {
        return $this->getValue();
    }

    /**
     * @return null
     */
    protected function input()
    {
        return null;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function userInput($input)
    {
        $input = str_replace('(:value)', $this->getValue(), $input);
        $input = str_replace('(:name)', $this->getName(), $input);
        $input = str_replace('(:label)', $this->getTitle(), $input);

        return $input;
    }

    /**
     * @return bool|mixed|null|string
     */
    public function output()
    {
        $this->value = $this->getValue();
        $userInput = $this->getOption('input');

        if ($userInput) {
            $output = $this->userInput($userInput);
        } else {
            $output = $this->input();    
        }

        return $this->onOutput($output);
    }

    public function getHooks() {
        if ($this->hooks) return $this->hooks;
        
        return $this->hooks = $this->getOption('hooks');    
    }

    public function onOutput($output) {
        $hooks = $this->getHooks(); 

        if (isset($hooks['onOutput']) && is_callable($hooks['onOutput'])) {
            return $hooks['onOutput']($output);
        }

        return $output;
    }

    /**
     * @param string $type_class
     * @return string
     */
    public function getType()
    {
        if ($this->type) return $this->type;

        $pieces = explode('\\', get_called_class());

        return strtolower(end($pieces));
    }

}
