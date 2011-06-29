<?PHP
namespace elizabethae\plugin;
require_once __DIR__."/pluginBase.php";

class load_config extends pluginBase{
    public $before_filter = array("require" => array("parse_mail"));

    function before_filter(){
        $this->data["res"][] = "load_config";
    }
}

?>