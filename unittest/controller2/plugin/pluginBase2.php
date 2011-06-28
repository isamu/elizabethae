<?PHP
namespace elizabethae\plugin;

class pluginBase2{
    public $required = array();
    public $require = array();
    public $before_filter = array("require" => null, "required" => null,);
    public $after_filter = array("require" => null, "required" => null,);

    function init_param(&$param){
        $this->param = &$param;
    }
    function init_data(&$data){
        $this->data = &$data;
    }
    function __construct(){
    }
    function before_filter(){
    }
    function after_filter(){
    }
}
?>