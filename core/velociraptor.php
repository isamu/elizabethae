<?PHP
/**
 * Velociraptor class is abstruct data model class 
 * This is a part of elizabethae framework.
 * 
 */
namespace velociraptor\core;
use \velociraptor\util\dbconnector;

require_once("velociraptor_dbconnector.php");


class velociraptor {
    function __call($function, $args) {
        if(preg_match("/^find_by_([\w\d]+)$/", $function, $match)){
            $this->find($match[1], $args[0]);
        }
    }

    function find($column, $cond){
        $conn = $this->find_connection("read", array());
        $stmt = $conn->query("SELECT * FROM ".$this->get_model_name() . " where " . $column . "= '" . $cond . "'");
        
        if($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $this->set_property($row);
            return true;
        }
        return false;
    }

    function set_property($row){
        foreach ($row as $k => $v){
            $this->{$k} = $v;
        }
    }

    /*
     * find data source
     * model + algorithm
     * model + real
     *         write
     * read
     * write
     *
     * default
     */
    function find_connection($method, $condition){
        $dbconn = dbconnector::getInstance();
        return $dbconn->get_connection($method, $this->get_model_name());
    }
    
    function get_model_name(){
        return array_pop(split("\\\\", get_class($this)));
    }
}
?>