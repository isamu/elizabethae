<?PHP
  // dispatcher
  /* add httpd.conf
<Directory "{YOUR HTDOC PATH}">
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !favicon.ico$
        RewriteRule ^(.*)$ index.php [QSA,L]
</Directory>

  */

  //todo default controller, default action
  //     routing by regular expression
  //     default error page
namespace elizabethae\util;

class dispatcher{
    function __construct(){
        list($controller, $action, $param) = $this->getControllerAndAction();
        $controller_file = APP_BASE_DIR . "/controller/".$controller.".php";
        if(file_exists($controller_file)){
            $controller_name = '\elizabethae\controller\\'.$controller;
            new $controller_name($action, $param);
        }else{
            echo "not found";
        }
    }

    function getControllerName($paths){
        return (((empty($paths[1]) || !preg_match("/^\w+$/",$paths[1]))  ? ( defined("DEFAULT_CONTROLLER") ? DEFAULT_CONTROLLER : "default") : $paths[1]) . "Controller");
    }

    function getActionName($paths){
        return ((empty($paths[2]) || !preg_match("/^(\w+)(\.\w+)?$/",$paths[2], $m)) ? "index" : $m[1]) . "Action";
    }

    function getControllerAndAction(){
        foreach($GLOBALS['dispatch']['rule'] as $rule){
            if($rule['regex']){
                if(preg_match($rule['regex'], $_SERVER['REQUEST_URI'], $m)){
                    $param = array();
                    foreach((array) $rule['match'] as $k => $match){
                        $param[$match] = $m[$k];
                    }
                    return array($rule['controller']."Controller", $rule['action']."Action", $param);
                }
            }
        }
        $path = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        $paths = explode("/", $path);
        return array($this->getControllerName($paths),
                     $this->getActionName($paths),
                     array());
    }

}
?>