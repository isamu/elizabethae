<?PHP
spl_autoload_register(function($name){
                          $names = preg_split("#\\\#", preg_replace("/^\\\/", "",  $name));
                          if (in_array($names[0], array("elizabethae", "velociraptor"))){
                              if ($names[1] == "core"){
                                      require_once ELIZABETHAE_BASE_DIR ."/core/" . $names[2] . ".php";
                              } elseif ($names[1] == "util"){
                                  if($names[0] == "elizabethae"){
                                      require_once ELIZABETHAE_BASE_DIR ."/core/util/". $names[2] . ".php";
                                  }else{
                                      require_once ELIZABETHAE_BASE_DIR ."/core/util/". $names[0] . "_" . $names[2] . ".php";
                                  }
                              } else {
                                  require_once APP_BASE_DIR . "/" . $names[1] . "/" . $names[2] . ".php"; 
                              }
                          }
                      });
?>