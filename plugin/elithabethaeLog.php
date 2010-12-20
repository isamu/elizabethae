<?PHP
namespace elizabethae\plugin;

class elithabethaeLog{
    function __construct(){
        date_default_timezone_set('Asia/Tokyo');
    }
    
    function debug($str, $val=NULL){
        $debug =  "Debug log : " . date("Y-m-d G:i:s") . " " . $str . ((!!$val) ? " ".var_export($val, TRUE) : "") ."\n";
        error_log($debug, 3, APP_BASE_DIR."/log/debug.log");
    }
}
?>