<?PHP
namespace elizabethae\controller;
require_once ELIZABETHAE_BASE_DIR."/core/elizabethae.php";

class filterOnController extends \elizabethae\core\elizabethae{
    public $before_filter = array("before_function");
    public $after_filter = array("after_function");

    function __construct($method_name){
        parent::__construct($method_name);
    }

    function get_data(){
        return $this->data;
    }

    function before_function(){
        $this->data["res"][] = "before";
    }

    function after_function(){
        $this->data["res"][] = "after";
    }

}

class filterDependencyOnController extends \elizabethae\core\elizabethae{
    function __construct($method_name){
        parent::__construct($method_name);
    }

    function get_data(){
        return $this->data;
    }

    function load_config(){
        $this->data["res"][] = "load_config";
    }

    function user_auth(){
        $this->data["res"][] = "user_auth";
    }

    function load_page(){
        $this->data["res"][] = "load_page";
    }
}
class filterDependencyTest1OnController extends filterDependencyOnController{
    public $before_filter = array(
        "load_config" => array(),
        "load_page" => array(
            "require" => "load_config",
            "required" => "user_auth",
        ),
        "user_auth" => array()
    );
}

class filterDependencyTest2OnController extends filterDependencyOnController{
    public $before_filter = array(
        "load_config" => array(
            "required" =>  "load_page"
        ),
        "load_page" => array(),
        "user_auth" => array(
            "require" => "load_page"
        )
    );
}

class filterDependencyTest3OnController extends filterDependencyOnController{
    public $before_filter = array(
        "load_config" => array(
            "required" =>  "load_page"
        ),
        "load_page" => array(
            "required" => "user_auth",
        ),
        "user_auth" => array()
    );
}

?>