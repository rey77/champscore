<?php

class Database
{
    private static $pdoInstance = null;

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    public static function __callStatic($name, $args)
    {
        $callback = array(self::connect(), $name);
        return call_user_func_array($callback, $args);
    }

    public static function connect()
    {
        if (self:: $pdoInstance) {
            return self:: $pdoInstance;
        }

        $iniFile = "config.ini";
        $databaseConfig = parse_ini_file($iniFile, true)["database"];

        $dsn = $databaseConfig ["dbDriver"] . ":host=" . $databaseConfig ["dbHost"] . "; dbname=" . $databaseConfig ["dbName"];

        self:: $pdoInstance = new PDO ($dsn, $databaseConfig ["dbUser"], $databaseConfig ["dbPassword"]);
        self:: $pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return self:: $pdoInstance;
    }

    public static function disconnect()
    {
        self::$pdoInstance = null;
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}