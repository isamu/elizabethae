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
        $this->find_connection("read", get_class($this), array());
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
    function find_connection($method, $model_name, $condition){
        $dbconn = dbconnector::getInstance();
        $velociraptor_dbconn = $dbconn->getDBConfig();
        $_model_name = array_pop(split("\\\\", $model_name));

        if (isset($velociraptor_dbconn['function'])){
            if (is_object($velociraptor_dbconn['function'])){
                /* in case closer */
                $velociraptor_dbconn['function']();
            } elseif(is_string($velociraptor_dbconn['function'])){
                $this->{$velociraptor_dbconn['function']}();
            }
        }
        if (isset($velociraptor_dbconn[$_model_name . '_function'])){
            if (is_object($velociraptor_dbconn[$_model_name . '_function'])){
                /* in case closer */
                $velociraptor_dbconn[$_model_name . '_function']();
            } elseif(is_string($velociraptor_dbconn[$_model_name . '_function'])){
                $this->{$velociraptor_dbconn[$_model_name . '_function']}();
            }
        }
        if (isset($velociraptor_dbconn[$_model_name . '_' . $method])){
            
        }
        if (isset($velociraptor_dbconn[$_model_name])){
            
        }
        if (isset($velociraptor_dbconn[$method])){
            
        }
        if (isset($velociraptor_dbconn['default'])){
            
        }
    }
    
}
?>