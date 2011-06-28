<?PHP
namespace elizabethae\plugin;

require_once("pluginBase2.php");
class test_plugin extends pluginBase2{

    function before_filter(){
        $this->data["test"]["plugin_test_before_filter"] = true;
    }
    function after_filter(){
        $this->data["test"]["test_param"] = $this->param;
    }
}
?>