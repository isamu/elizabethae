<?PHP
require_once APP_BASE_DIR . "/controller/ApplicationController.php";

class pluginParamTestController extends ApplicationController{
    public $data = array();
    public $test2 = array("test" => "plugin param test (test2)");
    function __construct($method_name){
        $this->plugin_dir = APP_BASE_DIR . "/controller/plugin_test/";
        parent::__construct($method_name);
    }

}
?>

