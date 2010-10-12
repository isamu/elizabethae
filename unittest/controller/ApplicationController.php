<?PHP
require_once ELIZABETHAE_BASE_DIR."/core/elizabethae.php";

class ApplicationController extends elizabethae{
    public $before_filter = array();
    public $after_filter = array("render");

    function __construct($method_name){
        parent::__construct($method_name);
    }

    function render(){
        $controller_name =  preg_replace("/Controller$/", "", get_class($this));
        $action_name = preg_replace("/Action$/", "", $this->method_name);
        $view_file = APP_BASE_DIR. "/view/" . $controller_name . "/" . $action_name . ".php";
        if(file_exists($view_file)){
            require_once($view_file);
        }
    }
}
?>