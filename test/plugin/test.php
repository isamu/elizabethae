<?PHP
namespace elizabethae\plugin;

require_once("pluginBase.php");
class test extends pluginBase{

    function before_filter(){
        $this->data["test"]["plugin_test_before_filter"] = true;
    }
    function after_filter(){
        $this->data["test"]["test_param"] = $this->param;
    }
}
?>