<?php

class database {

    private $hostname= "localhost";
    private $database= "tienda";
    private $username= "root";
    private $password= "";
    private $charset= "utf8";

    function conectar()
    {
        try{
        $conexion= "msql:host=" . $this->hostname. "; dbname=". $this->database. "; user=".  $this->username . 
        "pd=". $this->password."charted=". $this->charset;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $pdo= new PDO($conexion, $this->username, $this->password, $options); 

        return $pdo;
        
        }catch(PDOException $e){
            echo 'Error conexion: '. $e->getMessage();
            exit;
    }
}

}