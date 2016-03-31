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
     * @param array $fields
     * @param array $classMap
     */
    public function __construct(ParserInterface $parser, $fields = [], $classMap = [])
    {
        $this->parser = $parser;
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
        $typeClass = $this->getFieldTypeClass($type);

        return new $typeClass($name, $value, $options);
    }

    /**
     * @param $type
     * @throws \Exception
     */
    protected function getFieldTypeClass($type)
    {
        if (isset($this->classMap[$type])) return $this->classMap[$type];

        if (class_exists($this->namespace . Str::studly($type))) {
            return $this->namespace . Str::studly($type);
        }

        throw new \Exception("No supported Field Type [{$type}]");
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

        return [$type, $name, $value, $options];
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
}