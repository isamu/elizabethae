<?PHP
require_once APP_BASE_DIR . "/controller/ApplicationController.php";

class testController extends ApplicationController{
    function __construct($method_name){
        parent::__construct($method_name);
    }
    function indexAction(){
        $this->debug("this is index action");
        echo "do Action!!";
        require_once(APP_BASE_DIR."/view/test/index.php");
    }

}
?>