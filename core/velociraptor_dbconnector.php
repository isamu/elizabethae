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
    private $connections = array();

    function setDBCofig($config){
        $this->config = $config;
    }
    function getDBConfig(){
        return  $this->config;
    }
    
    function get_connection($method, $model_name){
        $config =  $this->find_config($method, $model_name);
        $key = hash("md5", json_encode($config));
        if(isset($this->connections[$key])){
            return $this->connections[$key];
        }
        $this->connections[$key] = $this->_get_connection($config);
        return $this->connections[$key];
    }
    function _get_connection($config){
        if($config['db'] == 'mysql'){
            $dsn = 'mysql:dbname='.$config['dbname'].';host='.$config['host'];
            $user = $config['user'];
            $password = $config['password'];
        }        
        $dbh = new \PDO($dsn, $user, $password);
        return $dbh;
    }
    function find_config($method, $model_name){
        if (isset($this->config['function'])){
            if (is_object($this->config['function'])){
                /* in case closer */
                $this->config['function']();
            } elseif(is_string($this->config['function'])){
                $this->{$this->config['function']}();
            }
        }
        if (isset($this->config[$model_name . '_function'])){
            if (is_object($this->config[$model_name . '_function'])){
                /* in case closer */
                $this->config[$model_name . '_function']();
            } elseif(is_string($this->config[$model_name . '_function'])){
                $this->{$this->config[$model_name . '_function']}();
            }
        }
        if (isset($this->config[$model_name . '_' . $method])){
            
        }
        if (isset($this->config[$model_name])){
            
        }
        if (isset($this->config[$method])){
            return $this->_find_config($this->config[$method]);
        }
        if (isset($this->config['default'])){
            return $this->_find_config($this->config['default']);
        }
    }    

    function _find_config($configs){
        if(isset($configs["db"])){
            return $configs;
        }else{
            return $configs[mt_rand(0, count($configs) - 1)];
        }
    }
}
