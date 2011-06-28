<?PHP
namespace elizabethae\plugin;
require_once("pluginBase.php");

class test3 extends \elizabethae\plugin\pluginBase{
    public $required = array();
    public $require = array();

    function __construct($controller){
        $this->controller = $controller;
    }
    function init_param($param){
        $this->param = $param;
    }
    function before_filter(){
        $this->controller->data["test"][] = "test3 plugin before filter";
    }
}
?>