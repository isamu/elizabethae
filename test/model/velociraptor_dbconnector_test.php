<?PHP
require_once("../../core/velociraptor_dbconnector.php");

use velociraptor\util\dbconnector;

$dbconn = dbconnector::getInstance();
$dbconn->enableTest();
$dbconn->setDBCofig(array("default" => array("db" => "mysql",
                                             "dbname" => "test",
                                             "host" => "192.168.1.1",
                                             "user" => "test",
                                             "password" => "pass")));
$res = $dbconn->get_connection("read", "user");

var_dump($res);