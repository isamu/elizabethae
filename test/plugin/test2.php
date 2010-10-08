<?PHP
require_once("pluginBase.php");
class test2 extends pluginBase{
    public $before_filter = array("requires" => array("test3"),
                                  "require" => array("test"));

    function init_param($param){
        $this->param = $param;
    }
    function before_filter(){
    }

    function test2Method(){
        echo "test2!!!\n";
    }
}
?>