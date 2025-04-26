<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web - Login Aluno</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="servicos_forms">

    <?php
    // Verificar se houve tentativa de login
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $alunos = [
            "ana" => "111",
            "bruno" => "222",
            "carla" => "333",
            "daniel" => "444"
        ];

        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        if (isset($alunos[$nome]) && $alunos[$nome] === $senha) {
            // Redireciona automaticamente para a página "dashboard"
            header("Location: loginSelecaoAluno.php");
            exit(); // Interrompe o script após o redirecionamento
        } else {
            echo "<p style='color:red;'>Nome ou senha incorretos. Tente novamente.</p>";
        }
    }
    ?>

    <div class="form_container">
        <!-- Formulário de Login -->
        <form class="form" method="post" action="">

            <h2>Login Aluno</h2>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
            <br><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>
            <br><br>

            <button type="submit">Login</button>
           
        </form>
    </div>
    <a href="../index.php">Home Page</a><br><br>

    </body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>

</html>
