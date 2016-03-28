<?php namespace Mascame\Formality\Factory;

use \Illuminate\Support\Str as Str;

interface FactoryInterface
{

    /**
     * @param $type
     * @param $name
     * @param $value
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    public function make($type, $name, $value, $options = []);

    /**
     * @param $data
     * @return mixed
     */
    public function makeFields();
}