<?PHP
namespace elizabethae\controller;
require_once ELIZABETHAE_BASE_DIR."/core/elizabethae.php";

class pluginFilterController extends \elizabethae\core\elizabethae{
    function __construct($method_name){
        $this->plugin_dir = APP_BASE_DIR . "/controller/mail_plugin1/";
        parent::__construct($method_name);
    }

    function get_data(){
        return $this->data;
    }
}

class pluginArroundFilterController extends \elizabethae\core\elizabethae{
    function __construct($method_name){
        $this->plugin_dir = APP_BASE_DIR . "/controller/arround_filter_plugin/";
        parent::__construct($method_name);
    }

    function get_data(){
        return $this->data;
    }
}

class pluginFilterParamsController extends \elizabethae\core\elizabethae{
    public $before_filter = array("plugin_validation");

    public $plugin_validation = array("validate_rule_1");
    public $plugin_validation_only_my_method = array("validate_rule_my_method");



    function __construct($method_name){
        $this->plugin_dir = APP_BASE_DIR . "/controller/filter_params_plugin/";
        parent::__construct($method_name);
    }

    function get_data(){
        return $this->data;
    }
}
class pluginFilterParams2Controller extends \elizabethae\controller\pluginFilterParamsController{
    public $plugin_validation_with_default = array("validate_rule_2");
    public $plugin_validation_only_my_method2 = array("validate_rule_my_method2");
}
?>