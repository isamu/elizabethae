<?PHP
namespace elizabethae\plugin;

class mixin_plugin{
    function __construct($controller){
        $this->controller = $controller;
    }

    function function_of_mixin_plugin(){
        $this->controller->data["date_from_mixin_plugin"] = "success";
    }
}
?>