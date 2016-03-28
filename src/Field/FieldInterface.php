<?php namespace Mascame\Formality\Field;

interface FieldInterface
{
    /**
     * @return mixed
     */
    function getValue();

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
    function getWiki();

    /**
     * @return array
     */
    function getAttributes();

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
}