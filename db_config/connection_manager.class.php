<?php
class ConnectionManager{
    static function getConnection(){
        $dsn = "mysql:host=".HOST.";dbname=".DBNAME;
        $user = USER;
        $pass = PASS;
        return new PDO($dsn,$user,$pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));        
    }
}
?>