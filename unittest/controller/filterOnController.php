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
    function render(){
        $this->data["res"][] = "render";
    }
    function conv_encode(){
        $this->data["res"][] = "conv_encode";
    }
    function access_log(){
        $this->data["res"][] = "access_log";
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

    public $after_filter = array(
        "render",
        "conv_encode" => array(
            "require" => "render",
            "required" => "access_log",
        ),
        "access_log",
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

    public $after_filter = array(
        "render" => array(
            "required" => "conv_encode",
        ),
        "conv_encode",
        "access_log" => array(
            "require" => "conv_encode",
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

    public $after_filter = array(
        "render" => array(
            "required" => "conv_encode",
        ),
        "conv_encode" => array(
            "required" => "access_log"
        ),
        "access_log",
    );
}

class filterOnlyTestOnController extends filterDependencyOnController{
    public $before_filter = array(
        "load_config" => array(
            "only" => "my_page_action"
        ),
    );
}

class filterOnlyTest2OnController extends filterDependencyOnController{
    public $before_filter = array(
        "load_config" => array(
            "only" => array(
                "my_page_action",
                "your_page_action",
            )
        ),
    );
}

class filterExpectTestOnController extends filterDependencyOnController{
    public $before_filter = array(
        "load_config" => array(
            "expect" => "my_page_action"
        ),
    );
}

class filterExpectTest2OnController extends filterDependencyOnController{
    public $before_filter = array(
        "load_config" => array(
            "expect" => array(
                "my_page_action",
                "your_page_action",
            )
        ),
    );
}

class filterMissingTestOnController extends filterDependencyOnController{
    public $before_filter = array(
        "load_config" => array(
            "require" => "no_exist_function",
        ),
    );
}
