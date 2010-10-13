<?PHP
class render_base{
    private $controller;
    private $controller_name;
    private $action_name;
    function __construct($controller){
        $this->controller = $controller;
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

}
?>