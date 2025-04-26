<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web - Login Professor</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="servicos_forms">
    
    <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarios = [
                "adm" => "73",
                "nylton" => "123",
                "lucia" => "345",
                "roger" => "678"
            ];

            $nome = $_POST['nome'];
            $senha = $_POST['senha'];
            $tipo_calculo = $_POST['tipo_calculo'];

            if (isset($usuarios[$nome]) && $usuarios[$nome] === $senha) {
                header("Location:loginSelecaoProfessor.php");
                exit();
            } else {
                echo "<p style='color:red;'>Nome, senha incorretos ou opção não marcada no seletor.</p>";
            }
        }
    ?>

    <div class="form_container">
        <!-- Formulário de Login -->
    <form class="form" method="post" action="">
        
        <h2>Login Professor</h2>
        
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <br><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br><br>
        
        <button type="submit">Login</button>
    </form>

    </div>
    <a href="../index.php">Home Page</a>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>

</html>
