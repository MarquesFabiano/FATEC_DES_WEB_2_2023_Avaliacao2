<?php
require_once 'candidato.php';
require_once 'conecta.php';

$conexao = new Conexao();
$candidato = new Candidato($conexao);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $escolaPublica = isset($_POST["escolaPublica"]) ? true : false;

    if (!empty($id)) {
        $candidato->editarCandidato($id, $nome, $cpf, $telefone, $escolaPublica);
    } else {
        $candidato->cadastrarCandidato($nome, $cpf, $telefone, $escolaPublica);
    }
}

if (isset($_GET["action"])) {
    $action = $_GET["action"];

    if ($action == "delete" && isset($_GET["id"])) {
        $id = $_GET["id"];
        $candidato->excluirCandidato($id);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação 2: Desenvolvimento Web</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Cadastre-se para o Vestibular!</h1>
    </header>
    <main>
        <section>
            <h2>Insira suas informações</h2>

            <div>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="id" value="">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" required>


                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cpf" required>


                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" id="telefone" required>


                    <label for="escolaPublica">Você estudou em escola pública?</label>
                    <input type="radio" name="escolaPublica" id="escolaPublica" value="1">
                    <label for="escolaPublica">Sim</label>
                    <input type="radio" name="escolaPublica" id="escolaPublica" value="0">
                    <label for="escolaPublica">Não</label>

                    <input type="submit" value="Cadastrar">
                </form>
            </div>
        </section>

        <section>
            <?php
            $candidato->listarCandidatos();
            ?>
        </section>
    </main>
</body>

</html>
