<?PHP
/**
 * Velociraptor class is abstruct data model class 
 * This is a part of elizabethae framework.
 * 
 */
namespace velociraptor\core;
use \velociraptor\util\dbconnector;

class velociraptor {
    private $write_method = array("put", "create", "update");

    function __call($function, $args) {
        if(preg_match("/^find_by_([\w\d]+)$/", $function, $match)){
            $conn = $this->find_connection($this->read_or_write($match[1]));
            return $conn->find($this->get_model_name(), $match[1], $args[0]) && $this->set_property($conn->getRow());
        }else{
            $conn = $this->find_connection($this->read_or_write($function));
            return call_user_func_array(array($conn, $function), $args);
        }
    }

    private function read_or_write($name){
        return (in_array("name", $this->write_method)) ? "write" : "read";
    }

    //todo use bindparam
    function create($array){
        $conn = $this->find_connection("write", array());
        $conn->create($this->get_model_name(), $array);
        $this->set_property($conn->getRow());
    }

    function set_property($row){
        foreach ($row as $k => $v){
            $this->{strtolower($k)} = $v;
        }
        return true;
    }

    function find_connection($method, $condition){
        $dbconn = dbconnector::getInstance();
        return $dbconn->get_connection($method, $this->get_model_name());
    }
    
    function get_model_name(){
        return strtolower(array_pop(split("\\\\", get_class($this))));
    }
}

