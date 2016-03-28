<?php namespace Mascame\Formality\Type;

use App;
use Illuminate\Support\Str;
use Mascame\Formality\Field\AbstractField;
use Mascame\Formality\Field\FieldInterface;

class Type extends AbstractField implements TypeInterface
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
        parent::__construct($name, $value = null, $options = []);

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

        if ($userInput) return $this->userInput($userInput);

        return $this->input();
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
