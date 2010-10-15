<?PHP
require_once APP_BASE_DIR . "/controller/ApplicationController.php";

class testController extends ApplicationController{
    function __construct($method_name, $param){
        parent::__construct($method_name, $param);
    }
    function indexAction(){
        $this->debug("this is index action");
    }

}
?>