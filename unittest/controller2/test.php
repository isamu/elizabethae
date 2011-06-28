<?PHP
define("ELIZABETHAE_BASE_DIR", realpath(__DIR__."/../../"));
define("APP_BASE_DIR", realpath(__DIR__."/../"));

use elizabethae\controller\testController;

require_once ELIZABETHAE_BASE_DIR . "/lib/bootstrap.php";
require_once "testController.php";

class ElizabethaeTest2 extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    function test_filter_param(){
        $testController = new testController("testAction");
        $this->assertEquals($testController->getData(),
                            array("test" => array("plugin_test_before_filter" => true,
                                                  "plugin_test2_before_filter" => true,
                                                  "plugin_test3_before_filter" => true,
                                                  "expect_test" => true,
                                                  "plugin_test2_method" => true,
                                                  "test_method" => true,
                                                  "test_param" => array("A", "B"))));
    }

    function test_filter_param2(){
        $testController = new testController("ccAction");
        $this->assertEquals($testController->getData(),
                            array("test" => array("plugin_test_before_filter" => true,
                                                  "plugin_test2_before_filter" => true,
                                                  "plugin_test3_before_filter" => true,
                                                  "test_param" => array("A"))));


    }
}



?>