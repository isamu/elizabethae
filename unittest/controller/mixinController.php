<?PHP
namespace elizabethae\controller;
require_once ELIZABETHAE_BASE_DIR."/core/elizabethae.php";

class MixinController extends \elizabethae\core\elizabethae{
    public $before_filter = array();
    public $after_filter = array();

    function __construct($method_name){
        $this->plugin_dir = APP_BASE_DIR . "/controller/mixin_plugin/";
        parent::__construct($method_name);
    }

    function call_mixin_function(){
        $this->function_of_mixin_plugin();
    }

    function get_data(){
        return $this->data;
    }
    public $mixin_init_param_plugin = array("init_param1");
    public $mixin_init_param_plugin_only_init_test_func = array("init_param3");


}

class Mixin2Controller extends \elizabethae\controller\MixinController{
    public $mixin_init_param_plugin_with_default = array("init_param2");

}
?>