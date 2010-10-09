<?PHP
require_once("pluginBase.php");
class test extends pluginBase{

    function init_param($param){
        $this->param = $param;
    }
    function before_filter(){
    }
}
?>