<?PHP

namespace velociraptor\util;

class tokyotyrant{
    private $ttt;

    function __construct($config){
        $this->ttt  = new \TokyoTyrantTable($config['host'],
                                            $config['port']);
    }
    
    function get($key){
        return $this->ttt->get($key);
    }
    function put($key, $value){
        return $this->ttt->put($key, $value);
    }
}