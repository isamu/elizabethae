<?PHP
namespace elizabethae\plugin;

require_once ELIZABETHAE_BASE_DIR."/plugin/render_base.php";
require_once APP_BASE_DIR . "/lib/ext/smarty/libs/Smarty.class.php";

class render_smarty extends render_base{
    function __construct($controller){
        $this->smarty = new Smarty();
        $this->smarty->template_dir = APP_BASE_DIR . '/view/Smarty/';
        $this->smarty->compile_dir  = APP_BASE_DIR . '/tmp/Smarty/templates_c/';
        $this->smarty->config_dir   = APP_BASE_DIR . '/tmp/Smarty/configs/';
        $this->smarty->cache_dir    = APP_BASE_DIR . '/tmp/Smarty/cache/';
        parent::__construct($controller);
    }
    
    function after_filter(){
        $this->smarty->display($this->controller_name.'-'.$this->action_name.'.tpl');
    }
}

?>