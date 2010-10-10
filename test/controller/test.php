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
                               "cont_cc",
                               "cont_zz");
    


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
    function only_aaa(){
        echo "func only_aaa\n";
    }
    function cont_aa(){
        echo "func cont_aa\n";
    }
    function cont_cc(){
        echo "func cont_cc\n";
    }
    function cont_zz(){
        echo "func cont_zz\n";
    }
}    

new testController("TEST");
?>