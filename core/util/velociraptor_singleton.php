<?PHP
/**
 * Velociraptor class is abstruct data model class 
 * This is a part of elizabethae framework.
 * 
 */
namespace velociraptor\util;

class singleton{
    private static $singleton;

    private function __construct() {
    }

    public static function getInstance() {
        $className = get_called_class();
        if (self::$singleton == null) {
            self::$singleton = new $className();
        }
        return self::$singleton;
    }
}
