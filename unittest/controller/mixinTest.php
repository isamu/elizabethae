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
    }

    /**
     * mixin test.
     * call mixin_plugin function from controller
     */
    public function test_call_mixin_function()
    {
        $controller = new elizabethae\controller\mixinController("indexAction");
        $controller->call_mixin_function();
        $res = $controller->get_data();
        $this->assertEquals($res["date_from_mixin_plugin"], "success");
    }

    public function test_init_param_of_mixin_plugin()
    {
        $controller = new elizabethae\controller\mixinController("indexAction");
        $res = $controller->get_data();
        $this->assertEquals($res["init_param"], array("init_param1"));
    }

    public function test_init_param_with_default_of_mixin_plugin()
    {
        $controller = new elizabethae\controller\mixin2Controller("indexAction");
        $res = $controller->get_data();
        $this->assertEquals($res["init_param"],
            array(
                "init_param1",
                "init_param2")
        );
    }

    public function test_init_param_only_of_mixin_plugin(){
        $controller = new elizabethae\controller\mixinController("init_test_func");
        $res = $controller->get_data();
        $this->assertEquals($res["init_param"],
            array(
                "init_param1",
                "init_param3")
        );

    }

    public function test_init_data_of_mixin_plugin(){
        $controller = new elizabethae\controller\mixinController("indexAction");
        $controller->set_data();
        $res = $controller->get_data();
        $this->assertEquals($res["set_on_mixin_init_data_plugin"], "success");
        $res = $controller->get_plugin_data();
        $this->assertEquals($res["set_on_mixin_init_data_plugin"], "success");
    }

}