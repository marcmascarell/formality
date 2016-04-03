<?php namespace Mascame\Formality\Field;

use App;
use Illuminate\Support\Str;

class Field extends AbstractField implements TypeInterface
{

    /**
     * Field constructor.
     * @param $name
     * @param null $value
     * @param array $options
     */
    public function __construct($name, $value = null, $options = [])
    {
        $this->name = $name;
        $this->value = ($value) ? $value : $this->getOption('default');
        $this->options = $options;

        $this->setOptionProperties();
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

    public function onOutput($output) {
        if (isset($this->hooks['onOutput']) && is_callable($this->hooks['onOutput'])) {
            return $this->hooks['onOutput']($output);
        }

        return $output;
    }

}
