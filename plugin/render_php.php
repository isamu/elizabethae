<?PHP
namespace elizabethae\plugin;

require_once ELIZABETHAE_BASE_DIR."/plugin/render_base.php";

class render_php extends render_base{
    function __construct($controller){
        parent::__construct($controller);
    }
    
    function after_filter(){
        if(method_exists($this, "render_" . $this->controller->content_type)){
            $this->{"render_" . $this->controller->content_type}();
        }else{
            $this->render();
        }
    }
    function render_json(){
        echo json_encode($this->controller->data['text_html']);
    }
    function render_xml(){
        echo "<test></test>";
    }

    function render_html(){
        $this->render();
    }

    function render(){
        if($this->find_layout()){
            require_once($this->layout_file);
        }else{
            $this->render_body();
        }
    }

    function find_layout(){
        foreach(array($this->controller_name, "common") as $dir){
            $this->layout_file = APP_BASE_DIR. "/view/" . $dir . "/layout.php";
            if(file_exists($this->layout_file)){
                return true;
            }
        }
        return false;
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