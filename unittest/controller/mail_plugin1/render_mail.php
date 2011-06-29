<?PHP
namespace elizabethae\plugin;
require_once __DIR__."/pluginBase.php";

class render_mail extends pluginBase{
    function after_filter(){
        $this->data["res"][] = "render_mail";
    }
}

?>