<?PHP
namespace elizabethae\plugin;
require_once __DIR__."/pluginBase.php";

class arround_filter extends pluginBase{
    function before_filter(){
        $this->data["res"][] = "arround_filter(before_filter)";
    }
    function after_filter(){
        $this->data["res"][] = "arround_filter(after_filter)";
    }
}

?>