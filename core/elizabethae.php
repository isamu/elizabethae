<?PHP
  /**
   *  Elizabethae PHP Simple framerowk 
   *  This framework provide two feature
   *  mix-in function like ruby
   *  simple filter chain
   */
namespace elizabethae\core;

require_once ELIZABETHAE_BASE_DIR."/lib/TopologicalSort.php";

class elizabethae{
    public $filters = array();
    public $plugin_dir = "";
    public $plugin_class_names = array();
    public $plugin_classes = array();
    public $param = null;

    //load plugin and execute method
    function __construct($method_name, $param = null){
        $this->method_name = $method_name;
        $this->param = $param;
        $files = $this->find_plugin();
        $this->read_plugin($files);
        foreach($this->plugin_class_names as $class){
            $this->initialize_plugin($class, $method_name);
        }
        $this->set_filter("before_filter", $method_name);
        $this->apply_filter("before_filter", $this->sort_filter("before_filter"), $method_name);
        $this->{$method_name}();
        $this->set_filter("after_filter", $method_name);
        $this->apply_filter("after_filter", $this->sort_filter("after_filter"), $method_name);
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
                $this->filters[$filter][$class_name] = array("type" =>"class",
                                                             "require" => $class->{$filter}["require"],
                                                             "required" => $class->{$filter}["required"]);
            }

        }
        $this->plugin_classes[$class_name] = $class;
    }

    //get plugin initialize parametor from controller
    function get_plugin_initialize_param_from_controller($plugin_name, $method_name){
        return array_merge((array) $this->{$plugin_name},
                           (array) $this->{$plugin_name."_with_default"}, 
                           (array) $this->{$plugin_name."_only_".$method_name},
                           (array) $this->{$plugin_name."_with_default_only_".$method_name});
    }
    function call_method($callMethodName, $method_name){
        $args = $this->get_method_param_from_controller($callMethodName, $method_name);
        $this->{$callMethodName}($args);
    }

    function get_method_param_from_controller($method_name, $from_method_name){
        return array_merge((array) $this->{$method_name},
                           (array) $this->{$method_name."_with_default"},
                           (array) $this->{$method_name."_from_".$from_method_name."_with_default"});
    }
    
    function set_filter($name, $method_name){
        foreach((array) $this->{$name} as $filter_name => $filter){
            if(is_array($filter)){
                if($this->is_set_filter($filter, $method_name)){
                    $this->filters[$name][$filter_name] = array("type" => "method",
                                                                "require" => $filter['require'],
                                                                "required" => $filter['required']);
                }
            }else{
                $this->filters[$name][$filter] = array("type" => "method");
            }
        }
    }

    function is_set_filter($filter, $method_name){
        if(is_array($filter['only'])){
            if(!in_array($method_name, $filter['only'])){
                return false;
            }
        }
        if(is_array($filter['expect'])){
            if(in_array($method_name, $filter['expect'])){
                return false;
            }
        }
        return true;
    }
    
    function sort_filter($name){
        if(isset($this->filters[$name])){
            $this->ts = new \elizabethae\util\TopologicalSort;
            $this->ts->setNode($this->filters[$name]);
            return $res = $this->ts->sort();
        }
        return array();
    }

    function apply_filter($name, $sorted_filter, $method_name){
        foreach((array) $sorted_filter as $filter){
            if($this->filters[$name][$filter]['type'] == "class"){
                $args = $this->get_method_param_from_controller($filter, $method_name);
                $this->plugin_classes[$filter]->{$name}($args);
            }else if($this->filters[$name][$filter]['type'] == "method"){
                $this->call_method($filter, $method_name);
            }
        }
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