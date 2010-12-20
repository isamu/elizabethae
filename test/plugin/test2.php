<?PHP
namespace elizabethae\plugin;

require_once("pluginBase.php");
class test2 extends pluginBase{
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