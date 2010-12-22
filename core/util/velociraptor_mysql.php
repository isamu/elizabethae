<?PHP

namespace velociraptor\util;

class mysql{
    private $dbh;
    private $row;

    function __construct($config){
        $dsn = 'mysql:dbname='.$config['dbname'].';host='.$config['host'];
        $user = $config['user'];
        $password = $config['password'];
        
        $this->dbh = new \PDO($dsn, $user, $password);
    }

    //todo use bindparam
    function find($model_name, $column, $cond){
        $stmt = $this->dbh->query("SELECT * FROM ".$model_name . " where " . $column . "= '" . $cond . "'");
        return ($this->row = $stmt->fetch(\PDO::FETCH_ASSOC));
    }
    function getRow(){
        return $this->row;
    }

    function create($model_name, $array){
        $columns = array();
        $values = array();
        foreach($array as $k => $v){
            $columns[] = $k;
            $values[] = $this->dbh->quote($v);
        }
        $sth = $this->dbh->prepare("insert into " .$model_name . " (" . join($columns, ",") . ")  values (" . join($values, ", ") . ")" );
        if($sth->execute()){
            $array['id'] = $this->dbh->lastInsertId();
            $this->row = $array; 
            return true;
        }
        return false;
    }

}

