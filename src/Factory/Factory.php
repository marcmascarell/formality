<?php namespace Mascame\Formality\Factory;

use \Illuminate\Support\Str as Str;
use \Mascame\Formality\Parser\ParserInterface as ParserInterface;

class Factory implements FactoryInterface
{
    /**
     * @var array
     */
    protected $fields;

    /**
     * @var array
     */
    protected $types;

    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @var string
     */
    protected $namespace = '\Mascame\Formality\Types\\';

    /**
     * @var array
     */
    protected $classMap = [];

    /**
     * Factory constructor.
     * @param ParserInterface $parser
     * @param array $types
     * @param array $fields
     * @param array $classMap
     */
    public function __construct(ParserInterface $parser, $types = [], $fields = [], $classMap = [])
    {
        $this->parser = $parser;
        $this->types = $types;
        $this->fields = $fields;
        $this->classMap = $classMap;
    }

    /**
     * @param $type
     * @param $name
     * @param $value
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    public function make($type, $name, $value, $options = [])
    {
        $typeClass = $this->getFieldTypeClass($type, $this->namespace);

        if (! $typeClass) throw new \Exception("No supported Field Type [{$type}]");

        return new $typeClass($name, $value, $options);
    }

    /**
     * @param $type
     * @throws \Exception
     */
    protected function getFieldTypeClass($type, $namespace)
    {
        if (isset($this->classMap[$type])) return $this->classMap[$type];

        $typeClass = $namespace . Str::studly($type);

        if (class_exists($typeClass)) return $typeClass;

        return false;
    }

    protected function resolveFieldValues($name, $value) {
        $options = [];
        $type = null;

        // [0] => '', [1] => ''
        if (is_numeric($name)) {
            $name = $value;
            $value = null;
        }

        if (is_array($value)) {
            $values = $value;
            $value = null;

            if (isset($values['value'])) {
                $value = $values['value'];
                unset($values['value']);
            }

            if (isset($values['type'])) {
                $type = $values['type'];
                unset($values['type']);
            }

            // the rest are options
            $options = $values;
        }

        if (! $type) $type = $this->parser->parse($name);

        return [$type, $name, $value, array_merge($options, $this->getTypeOptions('default'), $this->getTypeOptions($type))];
    }

    /**
     * @param $data
     * @return mixed
     */
    public function makeFields()
    {
        $fields = [];

        foreach ($this->fields as $name => $value) {
            list($type, $name, $value, $options) = $this->resolveFieldValues($name, $value);

            $fields[$name] = $this->make($type, $name, $value, $options);
        }

        return $this->fields = $fields;
    }

    /**
     * @param $type
     * @return array
     */
    public function getTypeOptions($type)
    {
        if ( ! isset($this->types[$type])) return [];

        return $this->types[$type];
    }

    /**
     * @return array
     */
    public function getDefaultOptions()
    {
        return $this->getTypeOptions('default');
    }
}