<?php
require_once 'DBConnect.php';

$candidatoCRUD = new CandidatoCRUD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $escolaPublica = isset($_POST["escolaPublica"]) ? true : false;

    $candidatoCRUD->cadastrarCandidato($nome, $cpf, $telefone, $escolaPublica);
}

if (isset($_GET["action"])) {
    $action = $_GET["action"];

    if ($action == "delete" && isset($_GET["id"])) {
        $id = $_GET["id"];
        $candidatoCRUD->excluirCandidato($id);
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
            $candidatoCRUD->listarCandidatos();
            ?>
        </section>
    </main>
</body>

</html>
