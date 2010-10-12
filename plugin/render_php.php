<?PHP
class render_php{
    private $controller;
    function __construct($controller){
        $this->controller = $controller;
    }
    
    function after_filter(){
        $controller_name =  preg_replace("/Controller$/", "", get_class($this->controller));
        $action_name = preg_replace("/Action$/", "", $this->controller->method_name);
        $view_file = APP_BASE_DIR. "/view/" . $controller_name . "/" . $action_name . ".php";
        if(file_exists($view_file)){
            require_once($view_file);
        }
    }
}
?>