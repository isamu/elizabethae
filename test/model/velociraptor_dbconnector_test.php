<?PHP
require_once(realpath(__DIR__."/../../") . "/core/velociraptor_dbconnector.php");

use velociraptor\util\dbconnector;

class VelociraptorDbconnectorTest extends PHPUnit_Framework_TestCase
{
    /* model is user, book, shelf, shop */
    private $dbconn;
    private $configs;

    protected function setUp()
    {
        $this->dbconn = dbconnector::getInstance();
        $this->dbconn->enableTest();
        $this->configs = array("default" => array("db" => "mysql",
                                                  "dbname" => "defalut",
                                                  "host" => "192.168.1.1",
                                                  "user" => "test",
                                                  "password" => "pass"),
                               "read" => array("db" => "mysql",
                                               "dbname" => "read",
                                               "host" => "192.168.1.1",
                                               "user" => "test",
                                               "password" => "pass"),
                               "book" => array("db" => "mysql",
                                               "dbname" => "book",
                                               "host" => "192.168.1.1",
                                               "user" => "test",
                                               "password" => "pass"),
                               "shop_read" => array("db" => "mysql",
                                                    "dbname" => "shop_read",
                                                    "host" => "192.168.1.1",
                                                    "user" => "test",
                                                    "password" => "pass"));
        $this->dbconn->setDBCofig($this->configs);
    }

    function test_get_default_connection(){
        $this->assertEquals($this->dbconn->get_connection("write", "user"),
                            $this->configs["default"]);
    }

    function test_get_read_connection(){
        $this->assertEquals($this->dbconn->get_connection("read", "user"),
                            $this->configs["read"]);
    }
    function test_get_model_connection(){
        $this->assertEquals($this->dbconn->get_connection("read", "book"),
                            $this->configs["book"]);
        $this->assertEquals($this->dbconn->get_connection("write", "book"),
                            $this->configs["book"]);
    }
    function test_get_model_method_connection(){
        $this->assertEquals($this->dbconn->get_connection("read", "shop"),
                            $this->configs["shop_read"]);
        $this->assertEquals($this->dbconn->get_connection("write", "shop"),
                            $this->configs["default"]);
    }


}