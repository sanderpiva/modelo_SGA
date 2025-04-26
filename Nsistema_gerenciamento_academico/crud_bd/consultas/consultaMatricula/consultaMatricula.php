<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web Consulta Matricula</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Matricula</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID Aluno</th>
                <th>ID Disciplina</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../conexao.php'; // Inclui o arquivo de conexão

            $sql = "SELECT Aluno_id_aluno, Disciplina_id_disciplina FROM matricula";
            $res = mysqli_query($conn, $sql);

            if ($res === false) {
                echo "<tr><td colspan='3'>Erro ao consultar matrículas: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
            } elseif (mysqli_num_rows($res) > 0) {
                while ($reg = mysqli_fetch_assoc($res)) {
                    $id_aluno = $reg['Aluno_id_aluno'];
                    $id_disciplina = $reg['Disciplina_id_disciplina'];

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($id_aluno) . "</td>";
                    echo "<td>" . htmlspecialchars($id_disciplina) . "</td>";
                    echo "<td id='buttons-wrapper'>";
                    echo "<button onclick='atualizarMatricula(\"" . htmlspecialchars($id_aluno) . "\", \"" . htmlspecialchars($id_disciplina) . "\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                    echo "<button onclick='excluirMatricula(\"" . htmlspecialchars($id_aluno) . "\", \"" . htmlspecialchars($id_disciplina) . "\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhuma matrícula encontrada.</td></tr>";
            }

            mysqli_close($conn); // Fecha a conexão
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>

    <script>
        function atualizarMatricula(id_aluno, id_disciplina) {
            // Redireciona para o formulário de matrícula, passando os IDs como parâmetros
            // AJUSTE O CAMINHO ABAIXO conforme a localização REAL de formMatricula.php
            window.location.href = "../../cadastros/cadastroMatricula/formMatricula.php?id_aluno=" + encodeURIComponent(id_aluno) + "&id_disciplina=" + encodeURIComponent(id_disciplina);
        }

        function excluirMatricula(id_aluno, id_disciplina) {
            const confirmar = confirm("Tem certeza que deseja excluir a matrícula do Aluno ID: " + id_aluno + " na Disciplina ID: " + id_disciplina + "?");
            if (confirmar) {
                // Assume que excluirMatricula.php está na mesma pasta
                window.location.href = "excluirMatricula.php?id_aluno=" + encodeURIComponent(id_aluno) + "&id_disciplina=" + encodeURIComponent(id_disciplina);
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>