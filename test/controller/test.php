<?PHP
define("ELIZABETHAE_BASE_DIR", realpath(__DIR__."/../../"));
define("APP_BASE_DIR", realpath(__DIR__."/../"));

use elizabethae\controller\testController;

require_once ELIZABETHAE_BASE_DIR . "/lib/bootstrap.php";
require_once "testController.php";

class ElizabethaeTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    function test_get_default_connection(){
        $testController = new testController("TEST");
        var_dump($testController->getParam());
        
        $this->assertEquals("a", "a");
    }
}



?>