<?PHP
namespace elizabethae\plugin;
require_once __DIR__."/pluginBase.php";

class write_mail_log extends pluginBase{
    public $after_filter = array("require" => array("send_mail"));
    function after_filter(){
        $this->data["res"][] = "write_mail_log";
    }
}

?>