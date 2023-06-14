<?php
class Conexao {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "vestibular_fatec";
    private $conn;

    public function __construct(){
        $this-> conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error){
            die("Falha na conexão com o banco de dados: " . $this->conn->connect_error); 
        }
    }
   
    public function __destruct(){
        $this->conn->close();
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>
