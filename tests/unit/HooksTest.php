<?php


class HooksTest extends \Codeception\TestCase\Test
{
    protected $config = [];

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->config = [
            'password' => [
                'hooks' => [
                    'onOutput' => function($output) {

                    }
                ]
            ]
        ];
    }

    protected function _after()
    {
    }

    // tests
    public function testHookOnOutput()
    {
        $password = new \Mascame\Formality\Types\Password('password', null, $this->config['password']);

        $this->assertTrue(isset($password->getHooks()['onOutput']));
    }
}