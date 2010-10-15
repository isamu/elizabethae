<?PHP
class http_util{
    function is_post(){
        return ($_SERVER['REQUEST_METHOD'] == "POST");
    }
    function is_get(){
        return ($_SERVER['REQUEST_METHOD'] == "GET");
    }
}
?>