<?PHP
namespace elizabethae\plugin;
require_once __DIR__."/pluginBase.php";

class filter_param extends pluginBase{

    function plugin_validation($params){
        $this->data["res"] = $params;
    }
}

?>