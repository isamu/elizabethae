<?php
define("APP_BASE_DIR", realpath(__DIR__."/../"));
define("ELIZABETHAE_BASE_DIR", realpath(__DIR__."/../../"));
require_once ELIZABETHAE_BASE_DIR . "/lib/bootstrap.php";
require_once 'PHPUnit/Framework.php';

require_once APP_BASE_DIR.'/controller/mixinController.php';

/**
 * Test class for elizabethae.
 * Generated by PHPUnit on 2010-10-08 at 09:57:28.
 */
class mixinControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    elizabethae
     * @access protected
     */
    protected $controller;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp()
    {
        $this->controller = new elizabethae\controller\mixinController("indexAction");
    }

    /**
     * mixin test.
     * call mixin_plugin function from controller
     */
    public function test_call_mixin_function()
    {
        $this->controller->call_mixin_function();
        $res = $this->controller->get_data();
        $this->assertEquals($res, array("date_from_mixin_plugin" => "success"))
    }

}