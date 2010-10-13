<?PHP
require_once("pluginBase.php");
class test extends pluginBase{
    function __construct($controller){
        $this->controller = $controller;
    }
    function init_param($param){
        $this->param = $param;
    }
    function before_filter(){
        $this->controller->data["test"][] = "test plugin before filter";
    }
}
?>