<?PHP
require_once APP_BASE_DIR . "/controller/ApplicationController.php";
require_once ELIZABETHAE_BASE_DIR . "/lib/bootstrap.php";

class pluginTestController extends ApplicationController{
    public $data = array();

    function __construct($method_name){
        $this->plugin_dir = APP_BASE_DIR . "/controller/plugin_test/";
        parent::__construct($method_name);
    }

    function get_testData(){
        return $this->data['test'];
    }

}
?>

