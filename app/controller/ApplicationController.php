<?PHP
require_once ELIZABETHAE_BASE_DIR."/core/elizabethae.php";

class ApplicationController extends elizabethae{
    public $before_filter = array();
    public $after_filter = array();

    function __construct($method_name, $param){
        $this->plugin_dir = realpath(__DIR__."/../plugin/");
        parent::__construct($method_name, $param);
    }
}
?>