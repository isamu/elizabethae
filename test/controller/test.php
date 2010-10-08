<?PHP
require_once("../../core/elizabethae.php");

class testController extends Elizabethae{
    var $before_filter = array("only_aaa" =>
                               array("only" => array("aa", "cc"),
                                     "expect" => array("aa", "cc"),
                                     "require" => array("AA", "cc")));
    


    function __construct($methodName){
        $this->plugin_dir = realpath(__DIR__."/../plugin/");
        parent::__construct($methodName);
    }            
    var $test_with_default = array("A");
    var $test_only_TEST = array("B");
    var $test_with_default_only_TEST = array("C");

    function TEST(){
        $this->test2Method();
        echo "doneTEST";
    }

}    

new testController("TEST");
?>