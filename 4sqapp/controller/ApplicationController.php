<?PHP
namespace elizabethae\controller;

use velociraptor\util\dbconnector;

class ApplicationController extends \elizabethae\core\elizabethae{
    public $before_filter = array();
    public $after_filter = array();

    function __construct($method_name, $param){
        $dbconn = dbconnector::getInstance();
        $dbconn->setDBCofig($GLOBALS['db_config']);    

        $this->plugin_dir = realpath(__DIR__."/../plugin/");
        parent::__construct($method_name, $param);
    }
}
?>