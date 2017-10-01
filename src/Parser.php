<?php

namespace Mascame\Formality;

use Illuminate\Support\Str as Str;

class Parser implements ParserInterface
{
    /**
     * @var array
     */
    protected $types = [];

    /**
     * @var array
     */
    private $typeReason = [];

    /**
     * @param $types
     * @param array $classMap
     */
    public function __construct($types)
    {
        $this->types = $types;
    }

    /**
     * @return array
     */
    protected function getTypes()
    {
        return $this->types;
    }

    /**
     * @param $name
     * @param $types
     * @return bool
     */
    protected function isTypeEqual($name, $types)
    {
        if (in_array(Str::snake($name), array_keys($types))
            || in_array(strtolower($name), array_keys($types))
        ) {
            $this->setTypeReason($name, 'equal');

            return true;
        }

        return false;
    }

    /**
     * @param $fields
     * @param $name
     * @param $type
     * @return int
     */
    protected function getSimilarityPoints($fields, $name, $type)
    {
        $points = 0;

        if ($this->isSimilar($name, $type)) {
            // Gives more importance to similar TYPE than field
            $points = +2;
        }

        foreach ($fields as $field) {
            if ($this->isSimilar($name, $field)) {
                $points++;
            }
        }

        return $points;
    }

    /**
     * @param $name
     * @param $types
     * @return bool|mixed
     */
    protected function isTypeSimilar($name, $types)
    {
        $points = [];

        foreach ($types as $type => $data) {
            if (! isset($data['autodetect'])) {
                continue;
            }

            $points[$type] = $this->getSimilarityPoints($data['autodetect'], $name, $type);
        }

        if (! empty($points) && max($points) > 0) {
            $this->setTypeReason($name, 'similar to one in options');

            return array_search(max($points), $points);
        }

        return false;
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    protected function isSimilar($haystack, $needle)
    {
        return Str::startsWith($haystack, $needle)
        || Str::endsWith($haystack, $needle)
        || Str::contains($haystack, $needle);
    }

    /**
     * @param $name
     * @param $types
     * @return bool|int|string
     */
    protected function isUserType($name, $types)
    {
        foreach ($types as $type => $data) {
            if (! isset($data['autodetect'])) {
                continue;
            }

            if (in_array($name, $data['autodetect'])) {
                $this->setTypeReason($name, 'set by user in options');

                return $type;
            }
        }

        return false;
    }

    /**
     * @param $name
     * @param $types
     * @return bool|int|string
     */
    protected function matchesRegex($name, $types)
    {
        foreach ($types as $type => $data) {
            if (! isset($data['regex'])) {
                continue;
            }

            foreach ($data['regex'] as $regex) {
                if (preg_match($regex, $name, $matches)) {
                    $this->setTypeReason($name, "matched regex '{$regex}'");

                    return $type;
                }
            }
        }

        return false;
    }

    /**
     * @param $name
     * @return string
     */
    public function parse($name)
    {
        if ($type = $this->matchesRegex($name, $this->types)) {
            return $type;
        }

        if ($this->isTypeEqual($name, $this->types)) {
            return $name;
        }

        if ($type = $this->isUserType($name, $this->types)) {
            return $type;
        }

        if ($type = $this->isTypeSimilar($name, $this->types)) {
            return $type;
        }

        $this->setTypeReason($name, 'default');

        return $this->types['default']['type'];
    }

    /**
     * @param $name
     * @param $value
     */
    protected function setTypeReason($name, $value)
    {
        $this->typeReason[$name] = $value;
    }

    /**
     * @return array
     */
    public function getTypeReasons()
    {
        return $this->typeReason;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getTypeReason($name)
    {
        return $this->typeReason[$name];
    }
}
