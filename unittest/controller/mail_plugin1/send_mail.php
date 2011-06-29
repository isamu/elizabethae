<?PHP
namespace elizabethae\plugin;
require_once __DIR__."/pluginBase.php";

class send_mail extends pluginBase{
    public $after_filter = array("require" => array("render_mail"));
    function after_filter(){
        $this->data["res"][] = "send_mail";
    }
}

?>