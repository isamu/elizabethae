<?PHP
require_once("pluginBase.php");
class test2 extends pluginBase{
    public $before_filter = array("requires" => array("test3"),
                                  "require" => array("test"));

    function __construct($controller){
        $this->controller = $controller;
    }
    function init_param($param){
        $this->param = $param;
    }
    function before_filter($param){
        if(isset($param['test'])){
            $this->controller->data["test"][] = $param['test'];
        }
        $this->controller->data["test"][] = "test2 plugin before filter";
    }

    function test2Method(){
    }
}
?>