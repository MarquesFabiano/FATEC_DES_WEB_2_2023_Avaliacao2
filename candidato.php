<?php
require_once 'conecta.php';
class Candidato
{
    private $conn;

    public function __construct(Conexao $conexao)
    {
        $this->conn = $conexao->getConnection();
    }
    public function cadastrarCandidato($nome, $cpf, $telefone, $escolaPublica)
    {
        $sql = "INSERT INTO usuario (nome, cpf, telefone, escola_publica) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $nome, $cpf, $telefone, $escolaPublica);

        if ($stmt->execute()) {
            echo "Candidato cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o candidato: " . $stmt->error;
        }
    }

    public function listarCandidatos()
    {
        $sql = "SELECT * FROM usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h2>Lista de Candidatos</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>CPF</th><th>Telefone</th><th>Escola Pública</th><th>Ações</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>"; //bora evitar um araque xss
                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cpf']) . "</td>";
                echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
                echo "<td>" . ($row['escola_publica'] ? 'Sim' : 'Não') . "</td>";
                echo "<td><a href='index.php?action=delete&id=" . htmlspecialchars($row['id']) . "'>Excluir</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum candidato encontrado.";
        }
    }


    public function editarCandidato($id, $nome, $cpf, $telefone, $escolaPublica)
    {
        $sql = "UPDATE usuario SET nome='$nome', cpf='$cpf', telefone='$telefone', escola_publica='$escolaPublica' WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Candidato atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o candidato: " . $this->conn->error;
        }
    }

    public function excluirCandidato($id)
    {
        $sql = "DELETE FROM usuario WHERE id='$id'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Candidato excluído com sucesso!";
        } else {
            echo "Erro ao excluir o candidato: " . $this->conn->error;
        }
    }
}

?>