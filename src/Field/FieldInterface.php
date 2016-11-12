<?php

namespace Mascame\Formality\Field;

interface FieldInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param $value
     * @return mixed
     */
    public function setValue($value);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return string
     */
    public function getWiki();

    /**
     * @return array
     */
    public function getAttributes();

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function getOption($key, $default = null);

    /**
     * @return array
     */
    public function getOptions();

    /**
     * @param $options
     * @param bool $overwrite
     * @return mixed
     */
    public function setOptions($options, $overwrite = false);
}
