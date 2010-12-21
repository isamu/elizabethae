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
            return $this->find($match[1], $args[0]);
        }else{
            $conn = $this->find_connection($this->read_or_write($function));
            return call_user_func_array(array($conn, $function), $args);
        }
    }

    private function read_or_write($name){
        return (in_array("name", $this->write_method)) ? "write" : "read";
    }

    //todo use bindparam
    function find($column, $cond){
        $conn = $this->find_connection("read", array());
        $stmt = $conn->query("SELECT * FROM ".$this->get_model_name() . " where " . $column . "= '" . $cond . "'");
        
        if($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $this->set_property($row);
            return true;
        }
        return false;
    }

   
    //todo use bindparam
    function create($array){
        $conn = $this->find_connection("write", array());
        $columns = array();
        $values = array();
        foreach($array as $k => $v){
            $columns[] = $k;
            $values[] = $conn->quote($v);
        }
        $sth = $conn->prepare("insert into " .$this->get_model_name() . " (" . join($columns, ",") . ")  values (" . join($values, ", ") . ")" );
        if($sth->execute()){
            $array['id'] = $conn->lastInsertId();
            $this->set_property($array);
            return true;
        }
        return false;
    }

    function set_property($row){
        foreach ($row as $k => $v){
            $this->{strtolower($k)} = $v;
        }
    }

    function find_connection($method, $condition){
        $dbconn = dbconnector::getInstance();
        return $dbconn->get_connection($method, $this->get_model_name());
    }
    
    function get_model_name(){
        return strtolower(array_pop(split("\\\\", get_class($this))));
    }
}
?>