<?php

class CandidatoCRUD {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "vestibular_fatec";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function cadastrarCandidato($nome, $cpf, $telefone, $escolaPublica) {
        $sql = "INSERT INTO usuario (nome, cpf, telefone, escola_publica) VALUES ('$nome', '$cpf', '$telefone', '$escolaPublica')";

        if ($this->conn->query($sql) === TRUE) {
            echo "Candidato cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o candidato: " . $this->conn->error;
        }
    }

    public function listarCandidatos() {
        $sql = "SELECT * FROM usuario";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Lista de Candidatos</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>CPF</th><th>Telefone</th><th>Escola Pública</th><th>Ações</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['nome']."</td>";
                echo "<td>".$row['cpf']."</td>";
                echo "<td>".$row['telefone']."</td>";
                echo "<td>".($row['escola_publica'] ? 'Sim' : 'Não')."</td>";
                echo "<td><a href='index.php?action=delete&id=".$row['id']."'>Excluir</a></td>";
                echo "</tr>";
            }
            

            echo "</table>";
        } else {
            echo "Nenhum candidato encontrado.";
        }
    }

    //apesar da função estar feita, nao consigo coloca-la no html!
    //creio que devo criar um formulario para ela, mas ainda estou vendo como faço!
    public function editarCandidato($id, $nome, $cpf, $telefone, $escolaPublica) {
        $sql = "UPDATE usuario SET nome='$nome', cpf='$cpf', telefone='$telefone', escola_publica='$escolaPublica' WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Candidato atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o candidato: " . $this->conn->error;
        }
    }

    public function excluirCandidato($id) {
        $sql = "DELETE FROM usuario WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Candidato excluído com sucesso!";
        } else {
            echo "Erro ao excluir o candidato: " . $this->conn->error;
        }
    }
}
