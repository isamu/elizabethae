<?PHP
namespace elizabethae\plugin;

class mixin_init_param_plugin{
    function __construct($controller){
        $this->controller = $controller;
    }

    function init_param($init_param){
        $this->controller->data["init_param"] = $init_param;
    }
}
?>