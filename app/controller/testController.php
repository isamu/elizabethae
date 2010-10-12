<?PHP
require_once ELIZABETHAE_BASE_DIR."/core/elizabethae.php";

class testController extends elizabethae{
    function __construct($method_name){
        parent::__construct($method_name);
    }
    function indexAction(){
        echo "do Action!!";
    }
}
?>