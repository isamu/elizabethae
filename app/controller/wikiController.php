<?PHP
require_once APP_BASE_DIR . "/controller/ApplicationController.php";
require_once APP_BASE_DIR . "/lib/ext/php-markdown/markdown.php";

class wikiController extends ApplicationController{
    function __construct($method_name, $param){
        parent::__construct($method_name, $param);
    }
    function indexAction(){
        $this->data['page_name'] = ($this->param['page']) ? $this->param['page'] : "index";
        $file_path = APP_BASE_DIR."/data/".$this->data['page_name'].".txt";
        if($this->is_post()){
            file_put_contents($file_path, $_POST['text']);
        }
        $this->data['text'] = htmlspecialchars(file_get_contents($file_path), ENT_QUOTES, mb_internal_encoding());
        $this->data['text_html'] = $this->simple_parser($this->data['text']);
    }
    private function simple_parser($text){
        return Markdown($text);
    }
}
?>