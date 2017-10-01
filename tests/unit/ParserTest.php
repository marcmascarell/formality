<?php


class ParserTest extends \Codeception\TestCase\Test
{
    protected $config = [];

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        //$this->config = require_once __DIR__ .'/../_data/parserConfig.php';
    }

    protected function _after()
    {
    }

    // tests
    public function testRegex()
    {
        $config = [
            'datetime' => [
                'regex' => [
                    '/_at$/',
                ],
            ],
            'coconut' => [
                'regex' => [
                    '/^coco/',
                ],
            ],
            'numeric' => [
                'regex' => [
                    '/[0-9]+/',
                ],
            ],
        ];

        $parser = new \Mascame\Formality\Parser($config);

        $type = $parser->parse('created_at');
        $this->assertEquals($type, 'datetime');

        $type = $parser->parse('coco_drilo');
        $this->assertEquals($type, 'coconut');

        $type = $parser->parse('9832133');
        $this->assertEquals($type, 'numeric');
    }

    public function testStringAutodetect()
    {
        $config = [
            'datetime' => [
                'autodetect' => [
                    'date',
                    '_at',
                ],
            ],
            'coconut' => [
                'autodetect' => [
                    'nuts',
                    'coco',
                ],
            ],
            'numeric' => [
                'autodetect' => [
                    'number',
                    'zip',
                ],
            ],
        ];

        $parser = new \Mascame\Formality\Parser($config);

        $type = $parser->parse('created_at');
        $this->assertEquals($type, 'datetime');

        $type = $parser->parse('coconuts');
        $this->assertEquals($type, 'coconut');

        $type = $parser->parse('number_id');
        $this->assertEquals($type, 'numeric');
    }
}
