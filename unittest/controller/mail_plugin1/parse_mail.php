<?PHP
namespace elizabethae\plugin;
require_once __DIR__."/pluginBase.php";

class parse_mail extends pluginBase{
    function before_filter(){
        $this->data["res"][] = "parse_mail";
    }
}

?>