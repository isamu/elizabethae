<?PHP
namespace elizabethae\plugin;

class mixin_init_data_plugin{
    private $data;
    private $controller;

    function __construct($controller){
        $this->controller = $controller;
    }

    function init_data(&$init_data){
        $this->data = &$init_data;
    }

    function set_data(){
        $this->data["set_on_mixin_init_data_plugin"] = "success";
    }

    function get_plugin_data(){
        return $this->data;
    }

}
?>