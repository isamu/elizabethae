<?PHP
  /**
   *  Elizabethae PHP Simple framerowk 
   *  This framework provide two feature
   *  mix-in function like ruby
   *  simple filter chain
   */

class elizabethae{
    public $filters = array();
    public $plugin_dir = "";
    public $plugin_class_names = array();
    public $plugin_classes = array();
    public $plugin_filter = array();

    //load plugin and execute method
    function __construct($methodName){
        $files = $this->find_plugin();
        $this->read_plugin($files);
        foreach($this->plugin_class_names as $class){
            $this->initialize_plugin($class, $methodName);
        }
        //var_Dump($this->plugin_filter);
        //$this->sort_filter("before");
        $this->{$methodName}();
        //$this->sort_filter("after");
    }
    
    //find plugin files from plugin_dir, and return files
    function find_plugin(){
        $files = array();
        foreach(glob($this->plugin_dir."/*.php") as $file){
            $files[] = $file;
        }
        return $files;
    }
    
    //read plugin files
    function read_plugin($files){
        foreach((array) $files as $file){
            require_once $file;
            $this->plugin_class_names[] = preg_replace("/\.php$/","", basename($file));
        }
    }

    // load plugin(mix-in) class , set_initialize parametor, and/or set data
    // find plugin filter and set filter
    function initialize_plugin($class_name, $method_name){
        $class = new $class_name($this);
        if(method_exists($class, "init_param")){
            $class->init_param($this->get_plugin_initialize_param_from_controller($class_name, $method_name));
        }
        if(method_exists($class, "init_data")){
            $class->init_data($this->data);
        }
        foreach(array("before_filter", "after_filter") as $filter){
            if(method_exists($class, $filter)){
                $this->plugin_filter[$filter][] = $class;
            }
        }
        $this->plugin_classes[] = $class;
    }

    //get plugin initialize parametor from controller
    function get_plugin_initialize_param_from_controller($plugin_name, $method_name){
        return array_merge((array) $this->{$plugin_name},
                           (array) $this->{$plugin_name."_with_default"}, 
                           (array) $this->{$plugin_name."_only_".$method_name},
                           (array) $this->{$plugin_name."_with_default_only_".$method_name});
    }
    function call_method($callMethodName, $methodName){
        $args = $this->get_method_param_from_controller($callMethodName, $methodName);
        $this->{$callMethodName}($args);
    }
    function get_method_param_from_controller($method_name, $from_method_name){
        return array_merge((array) $this->{$method_name},
                           (array) $this->{$method_name."_with_default"},
                           (array) $this->{$method_name."_from_".$from_method_name."_with_default"});
    }
    
    function call_filter(){
    }
    
    function __get($param){
        //echo $param;
    }
    function __call($function, $args) {
        foreach ($this->plugin_classes as $class) {
            if (method_exists($class, $function)) {
                return call_user_func_array(array($class, $function), $args);
            }
        }
    }
}

?>