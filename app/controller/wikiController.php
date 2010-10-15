<?PHP
require_once APP_BASE_DIR . "/controller/ApplicationController.php";

class wikiController extends ApplicationController{
    function __construct($method_name, $param){
        parent::__construct($method_name, $param);
    }
    function indexAction(){
        $page_name = ($this->param['page']) ? $this->param['page'] : "index";
        if($this->is_post()){
            $this->data['post'] =  $_POST;
        }
    }

}
?>