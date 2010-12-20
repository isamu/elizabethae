<?PHP
namespace elizabethae\plugin;

require_once("pluginBase.php");
class test3 extends pluginBase{
    public $required = array();
    public $require = array();

    function before_filter(){
        $this->data["test"]["plugin_test3_before_filter"] = true;
    }
}
?>