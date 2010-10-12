<?PHP
class elithabethaeLog{
    function __construct(){
        date_default_timezone_set('Asia/Tokyo');
    }
    
    function debug($str, $val=NULL){
        if($val){
            $debug =  "Debug log : " . date("Y-m-d G:i:s") . " " . $str." ".var_export($val, TRUE)."\n";
        }else{
            $debug =  "Debug log : " . date("Y-m-d G:i:s") . " " . $str."\n";
        }

        error_log($debug, 3, APP_BASE_DIR."/log/debug.log");
    }
}
?>