<?php namespace Mascame\Formality\Field;

interface FieldInterface
{
    /**
     * @return mixed
     */
    function getValue();

    /**
     * @param $value
     * @return mixed
     */
    function setValue($value);

    /**
     * @return string
     */
    function getName();

    /**
     * @return string
     */
    function getTitle();

    /**
     * @return string
     */
    function getType();

    /**
     * @return string
     */
    function getWiki();

    /**
     * @return array
     */
    function getAttributes();

    /**
     * @return mixed
     */
    function getHooks();

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    function getOption($key, $default = null);

    /**
     * @return array
     */
    function getOptions();

    /**
     * @param $options
     * @param bool $overwrite
     * @return mixed
     */
    function setOptions($options, $overwrite = false);
}