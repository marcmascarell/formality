<?php namespace Mascame\Formality\Field;

use Illuminate\Support\Str;

class AbstractField implements FieldInterface
{
    /**
     * @var
     */
    protected $name;

    /**
     * @var
     */
    protected $value;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var mixed
     */
    protected $title;

    /**
     * @var string
     */
    protected $wiki;

    /**
     * @var TypeInterface
     */
    protected $type;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $hooks = [];

    /**
     * @param null $value
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setValue($value)
    {
        return $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        if ($this->title) return $this->title;

        return $this->title = $this->getOption('title') ? $this->getOption('title') : Str::title(str_replace('_', ' ', $this->name));
    }

    /**
     * @return string
     */
    public function getWiki()
    {
        return $this->wiki;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return array
     */
    public function getHooks() {
        return $this->hooks;
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function getOption($key, $default = null) {
        return (isset($this->options[$key])) ? $this->options[$key] : $default;
    }

    /**
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param $options
     * @param bool $overwrite
     * @return array
     */
    public function setOptions($options, $overwrite = false)
    {
        $this->options = ($overwrite) ? $options : array_merge($this->options, $options);

        $this->setOptionProperties();
    }

    /**
     * Set all properties based on the current options
     */
    protected function setOptionProperties() {
        $this->title = $this->getTitle();
        $this->wiki = $this->getOption('wiki');
        $this->attributes = $this->getOption('attributes', []);
        $this->hooks = $this->getOption('hooks', []);
        $this->type = $this->getType();
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