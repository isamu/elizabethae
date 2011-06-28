<?PHP
namespace elizabethae\controller;
require_once ELIZABETHAE_BASE_DIR . "/lib/bootstrap.php";

class testController extends \elizabethae\core\elizabethae{
    var $before_filter = array("only_aa" =>
                               array("only" => array("aa")),
                                     //"require" => array("cont_aa", "cont_cc"),
                                     //"required" => array("cont_zz")),
                               "expect_test" =>
                               array("expect" => array("ccAction")),
                               );



    function __construct($methodName){
        $this->plugin_dir = realpath(__DIR__."/plugin/")."/";
        $this->data = array();
        $this->data['test'] = array();
        parent::__construct($methodName);
    }

    function getParam(){
        return $this->param;
    }

    function getData(){
        return $this->data;
    }

    var $test_plugin_with_default = array("A");
    var $test_plugin_only_testAction = array("B");
    var $test_plugin_with_default_only_ccAction = array("C");

    function testAction(){
        $this->test2Method();
        $this->data["test"]["test_method"] = true;
    }
    function cont_aa(){
        $this->data["test"]["cont_aaa"] = true;
    }
    function expect_test(){
        $this->data["test"]["expect_test"] = true;
    }

}
