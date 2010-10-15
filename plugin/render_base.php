<?PHP
class render_base{
    protected $controller;
    protected $controller_name;
    protected $action_name;

    function __construct($controller){
        $this->controller = $controller;
        $this->controller_name = $this->getControllerName();
        $this->action_name = $this->getActionName();
    }
    
    function render_json(){
        echo "not implement";
    }
    function render_xml(){
        echo "not implement";
    }
    function render_mobile(){
        echo "not implement";
    }
    function render_yaml(){
        echo "not implement";
    }
    function render_txt(){
        echo "not implement";
    }
    function render(){
        echo "must implement";
    }

    protected function getControllerName(){
        return preg_replace("/Controller$/", "", get_class($this->controller));
    }
    protected function getActionName(){
        return  preg_replace("/Action$/", "", $this->controller->method_name);
    }
}
?>