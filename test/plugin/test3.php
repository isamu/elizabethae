<?PHP
namespace elizabethae\plugin;

require_once("pluginBase.php");
class test3 extends pluginBase{
    public $required = array();
    public $require = array();

    function init_param($param){
        $this->param = $param;
    }
    function before_filter(){
        echo "test3\n";
    }
}
?>