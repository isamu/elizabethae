<?PHP
/**
 * Velociraptor class is abstruct data model class 
 * This is a part of elizabethae framework.
 * 
 */
namespace velociraptor\util;

require_once("velociraptor_singleton.php");

class dbconnector extends Singleton{
    private $config;
    function setDBCofig($config){
        $this->config = $config;
    }
    function getDBConfig(){
        return  $this->config;
    }
}
