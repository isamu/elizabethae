<?PHP

namespace velociraptor\util;

class tokyotyrant{
    private $ttt;
    private $primary_key_name = "id";
    private $row;

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
    function create($model_name, $array){
        $key = $model_name . "_" . $array[$this->primary_key_name];
        unset($array[$this->primary_key_name]);
        $this->row = $array;
        return $this->ttt->put($key, $array);
    }
    function find($model_name, $key){
        $key = $model_name . "_" .$key;
        return $this->get($key);
    }
    function getRow(){
        return $this->row;
    }
    

}