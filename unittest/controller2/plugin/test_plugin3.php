<?PHP
namespace elizabethae\plugin;

require_once("pluginBase2.php");
class test_plugin3 extends pluginBase2{
    public $required = array();
    public $require = array();

    function before_filter(){
        $this->data["test"]["plugin_test3_before_filter"] = true;
    }
}
?>