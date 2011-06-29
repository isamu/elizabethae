<?PHP
namespace elizabethae\controller;
require_once ELIZABETHAE_BASE_DIR."/core/elizabethae.php";

class pluginFilterController extends \elizabethae\core\elizabethae{
    public $before_filter = array();
    public $after_filter = array();

    function __construct($method_name){
        $this->plugin_dir = APP_BASE_DIR . "/controller/mail_plugin1/";
        parent::__construct($method_name);
    }

    function get_data(){
        return $this->data;
    }
}

?>