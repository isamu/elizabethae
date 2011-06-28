<?PHP
namespace elizabethae\plugin;

require_once("pluginBase2.php");
class test_plugin2 extends pluginBase2{
    public $before_filter = array("requires" => array("test3"),
                                  "required" => null,
                                  "require" => array("test"));

    function before_filter(){
        $this->data["test"]["plugin_test2_before_filter"] = true;
    }

    function test2Method(){
        $this->data["test"]["plugin_test2_method"] = true;
    }
}
?>