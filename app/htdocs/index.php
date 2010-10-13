<?PHP
require_once(realpath(__DIR__."/../config/") . "/config.php");
require_once APP_BASE_DIR . "/lib/dispatcher.php";

new dispatcher();
?>