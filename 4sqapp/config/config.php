<?PHP
define("ELIZABETHAE_BASE_DIR", realpath(__DIR__."/../../"));
define("APP_BASE_DIR", realpath(__DIR__."/../"));
define("APP_PLUGIN_DIR", realpath(__DIR__."/../plugin/"));

define("DEFAULT_CONTROLLER", "foursq");

$dispatch['rule'][] = array("regex" => "#^/wiki/(\w+)\/?#",
                            "controller" => "4sq",
                            "action" => "index",
                            "match" => array(1 => "page"));

define("ConsumerKey", "QJKW12K5ODUNPX3X15O1D4UDIWXKXLAEJ20450JACCJ3G0MM");
define("ConsumerKeySecret", "V45KOOUH2JEDGDBMGTOXI4N0LKFMWXAOUBQIVBXS1KV3TK3W");

$db_config = array("default" => array("db" => "mysql",
                                      "dbname" => "4sq",
                                      "host" => "127.0.0.1",
                                      "user" => "root",
                                      "password" => ""),
                   "oauthsession" => array("db" => "tokyotyrant",
                                           "host" => "localhost",
                                           "port" => "1979"));

?>