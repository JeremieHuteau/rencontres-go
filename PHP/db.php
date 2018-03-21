<?php
/**
 *
 */
class DB
{
    private static $instance = NULL;

    public function __construct() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO(
                'mysql:host=hostName(server);dbname=dbName',
                'user', 'passWord');
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }

}

?>
