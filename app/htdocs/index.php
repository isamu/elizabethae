<?PHP
  // dispatcher
  /* add httpd.conf
   RewriteEngine on
   RewriteRule ^/$ /index.php [QSA]
   RewriteRule ^/([^.]+)$ /index.php [QSA]
   RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-f
   RewriteRule ^(.*)$ index.php [QSA,L]
  */

require_once(realpath(__DIR__."/../config/")."/config.php");


preg_match("#/(\w+)(/(\w+)?/?)?#", $_SERVER['SCRIPT_URL'], $m);
$controller = ((empty($m[1]) ? "default" : $m[1]) . "Controller");
$action = (empty($m[3]) ? "index" : $m[3]) . "Action";

$controller_file = APP_BASE_DIR . "/controller/".$controller.".php";
if(file_exists($controller_file)){
    require_once $controller_file;
    new $controller($action);
 }
?>