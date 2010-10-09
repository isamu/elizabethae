<?PHP
require_once("../../core/elizabethae.php");
require_once("../../lib/TopologicalSort.php");

class testController extends Elizabethae{
    var $before_filter = array("only_aaa" =>
                               array("only" => array("aa", "cc", "TEST"),
                                     "expect" => array("aa", "cc"),
                                     "require" => array("cont_aa", "cont_cc"),
                                     "required" => array("cont_zz")),
                               "cont_aa",
                               "cont_cc");
    


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
    function cont_aa(){
    }
    function cont_cc(){
    }
    function cont_zz(){
    }
}    

new testController("TEST");
?>