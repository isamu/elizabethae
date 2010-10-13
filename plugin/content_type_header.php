<?PHP
class content_type_header{
    public $before_filter = array("require" => array("set_content_type"));
    private $headers = array("json" => 'Content-Type: text/javascript; charset=utf8',
                             "xml" => 'Content-Type: text/xml; charset=utf-8',
                             "yaml" => 'Content-Type: text/yaml; charset=utf-8',
                             "html" => 'Content-type: text/html; charset=utf-8');
    
    function __construct($controller){
        $this->controller = $controller;
    }
    function before_filter(){
        if(isset($this->headers[$this->controller->content_type])){
            header($this->headers[$this->controller->content_type]);
        }else{
            header($this->headers['html']);
        }
    }
}
?>