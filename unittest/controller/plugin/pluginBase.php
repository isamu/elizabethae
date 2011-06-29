<?PHP
namespace elizabethae\plugin;

class pluginBase{
    public $controller;

    function __construct($controller){
        $this->controller = $controller;
    }
    function init_data(&$init_data){
        $this->data = &$init_data;
    }
}

?>