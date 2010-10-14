<?PHP
require_once APP_BASE_DIR . "/controller/ApplicationController.php";

class wikiController extends ApplicationController{
    function __construct($method_name){
        parent::__construct($method_name);
    }
    function indexAction(){
        //$this->debug("this is index action");
    }
    function writeAction(){
        $this->data['post'] =  $_POST;
    }

    function pageAction($page){
    }

    //replace dispatcher if support regex.
    function __call($func, $arg){
        if(preg_match("/(\w+)Action/", $func, $m)){
            $this->pageAction($m[1]);
        }else{
            parent::__call($func, $arg);
        }
    }

}
?>