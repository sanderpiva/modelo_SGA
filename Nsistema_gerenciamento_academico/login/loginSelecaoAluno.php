<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web - Login Aluno</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="servicos_forms">
    
<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Certifique-se de que a variável $_POST['tipo_calculo'] está definida antes de usá-la
        if (isset($_POST['tipo_atividade'])) {
            $tipo_atividade = $_POST['tipo_atividade'];

            if ($tipo_atividade === 'dinamica') {
                // Redireciona para a página de serviços
                header("Location: ../servicos_professor/selecao_dashboard_dinamico.php");
                exit();
            } elseif ($tipo_atividade === 'estatica') {
                // Redireciona para a página de resultados
                header("Location: ../servicos_professor/dashboard_alunos_algebrando_estatico.php");
                exit();
            } else {
                echo "<p style='color:red;'>Selecione uma opção válida.</p>";
            }
        } else {
            echo "<p style='color:red;'>Por favor, selecione uma opção no seletor.</p>";
        }
    }
    ?>
    <div class="form_container">
        <!-- Formulário de Login -->
    <form class="form" method="post" action="">
        
        <h2>Login Aluno</h2>
        
        <select id="tipo_atividade" name="tipo_atividade">
                <option value="">Selecione:</option>
                <option value="dinamica">Atividades dinâmicas</option>
                <option value="estatica">Dashboard Algebrando</option>
                
        </select><br><br>

        <button type="submit">Login</button>
    </form>

    </div>
    <a href="../index.php">Home Page</a>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>

</html>
