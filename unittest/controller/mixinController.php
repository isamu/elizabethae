<?PHP
namespace elizabethae\controller;
require_once ELIZABETHAE_BASE_DIR."/core/elizabethae.php";

class MixinController extends \elizabethae\core\elizabethae{
    public $before_filter = array();
    public $after_filter = array("render");

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

}
?>