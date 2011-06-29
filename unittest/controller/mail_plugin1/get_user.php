<?PHP
namespace elizabethae\plugin;
require_once __DIR__."/pluginBase.php";

class get_user extends pluginBase{
    public $before_filter = array("require" => array("load_config"));

    function before_filter(){
        $this->data["res"][] = "get_user";
    }
}

?>