<?php

class Connection{

    private $driver;
    private $host;
    private $user;
    private $pass;
    private $database;
    private $port;
    public $pdo;

    public function __construct(){
        $this->setConnect();
        $this->connect();
    }

    private function setConnect(){
        require 'Conf.php';

        $this->driver = $driver;
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
        $this->port = $port;
    }

    private function connect(){
        try {
            $con = "pgsql:host={$this->host};port={$this->port};dbname={$this->database}";
            $this->pdo = new PDO($con, $this->user, $this->pass);
            // Configura el modo de error de PDO para que lance excepciones
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conectado a la DB";
        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function getConnect(){
        return $this->pdo;
    }

    public function close(){
        $this->pdo = null;
    }
}
