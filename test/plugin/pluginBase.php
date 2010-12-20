<?PHP
namespace elizabethae\plugin;

class pluginBase{
    public $required = array();
    public $require = array();
    public $before_filter = array("require" => null, "required" => null,);
    public $after_filter = array("require" => null, "required" => null,);

    function __construct(){
    }
    function init_param($param){
    }
    function before_filter(){
    }
    function after_filter(){
    }
}
?>