<?PHP
class set_content_type{
    public $controller;
    function __construct($controller){
        $this->controller = $controller;
    }
    function before_filter(){
        $paths = explode("/", $_SERVER['REQUEST_URI']);
        if(preg_match("/^\w+\.(\w+)$/", $paths[2], $m)){
            $this->controller->content_type = $m[1];
        }else{
            $this->controller->content_type = "html";
        }

    }
}

?>