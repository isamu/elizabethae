<?PHP
  // dispatcher
  /* add httpd.conf
   RewriteEngine on
   RewriteRule ^/$ /index.php [QSA]
   RewriteRule ^/([^.]+)$ /index.php [QSA]
   RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-f
   RewriteRule ^(.*)$ index.php [QSA,L]
  */

  //todo default controller, default action
  //     routing by regular expression
  //     default error page

require_once(realpath(__DIR__."/../config/")."/config.php");

$paths = explode("/", $_SERVER['SCRIPT_URL']);
$controller = (((empty($paths[1]) || !preg_match("/^\w+$/",$paths[1]))  ? "default" : $paths[1]) . "Controller");
$action = ((empty($paths[2]) || !preg_match("/^\w+$/",$paths[2])) ? "index" : $paths[2]) . "Action";

$controller_file = APP_BASE_DIR . "/controller/".$controller.".php";
if(file_exists($controller_file)){
    require_once $controller_file;
    new $controller($action);
 }
?>