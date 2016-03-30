<?php namespace Mascame\Formality\Field;


use Illuminate\Support\Str;
use Mascame\Formality\Field\TypeInterface;

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
     * @param null $value
     * @return null
     */
    public function getValue()
    {
        return $this->value;
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

        return $this->title = $this->getOption('title') ? $this->getOption('title') : Str::title($this->name);
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
     * @return array
     */
    public function __get($name) {
        return isset($this->{$name}) ? $this->{$name} : null;
    }
}