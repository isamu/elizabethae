<?PHP
define("ELIZABETHAE_BASE_DIR", realpath(__DIR__."/../../"));
define("APP_BASE_DIR", realpath(__DIR__."/../"));
define("APP_PLUGIN_DIR", realpath(__DIR__."/../plugin/"));

define("DEFAULT_CONTROLLER", "wiki");

$dispatch['rule'][] = array("regex" => "#^/wiki/(\w)+\/?#",
                            "controller" => "wiki",
                            "page" => array("match" => 1));

?>