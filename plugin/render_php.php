<?PHP
class render_php{
    private $controller;
    private $controller_name;
    private $action_name;
    function __construct($controller){
        $this->controller = $controller;
    }
    
    function after_filter(){
        $this->controller_name =  preg_replace("/Controller$/", "", get_class($this->controller));
        $this->action_name = preg_replace("/Action$/", "", $this->controller->method_name);
        $layout_file = APP_BASE_DIR. "/view/" . $this->controller_name . "/layout.php";
        if(file_exists($layout_file)){
            require_once($layout_file);
        }else{
            $this->render_body();
        }
    }
    function render_body(){
        $view_file = APP_BASE_DIR. "/view/" . $this->controller_name . "/" . $this->action_name . ".php";
        if(file_exists($view_file)){
            require_once($view_file);
        }
    }

    function render_layout(){

    }

}
?>