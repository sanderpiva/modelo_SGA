<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Web Consulta Matrícula</title>
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Matrícula</h2>

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
            require_once '../conexao.php';

            try {
                $stmt = $conexao->query("SELECT Aluno_id_aluno, Disciplina_id_disciplina FROM matricula");
                $matriculas = $stmt->fetchAll();

                if (count($matriculas) > 0) {
                    foreach ($matriculas as $matricula) {
                        $id_aluno = htmlspecialchars($matricula['Aluno_id_aluno']);
                        $id_disciplina = htmlspecialchars($matricula['Disciplina_id_disciplina']);

                        echo "<tr>";
                        echo "<td>$id_aluno</td>";
                        echo "<td>$id_disciplina</td>";
                        echo "<td id='buttons-wrapper'>";
                        echo "<button onclick='atualizarMatricula(\"$id_aluno\", \"$id_disciplina\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                        echo "<button onclick='excluirMatricula(\"$id_aluno\", \"$id_disciplina\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhuma matrícula encontrada.</td></tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='3'>Erro ao consultar matrículas: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Voltar aos Serviços</a>

    <script>
        function atualizarMatricula(id_aluno, id_disciplina) {
            window.location.href = "../../cadastros/cadastroMatricula/formMatricula.php?id_aluno=" + encodeURIComponent(id_aluno) + "&id_disciplina=" + encodeURIComponent(id_disciplina);
        }

        function excluirMatricula(id_aluno, id_disciplina) {
            const confirmar = confirm("Tem certeza que deseja excluir a matrícula do Aluno ID: " + id_aluno + " na Disciplina ID: " + id_disciplina + "?");
            if (confirmar) {
                window.location.href = "excluirMatricula.php?id_aluno=" + encodeURIComponent(id_aluno) + "&id_disciplina=" + encodeURIComponent(id_disciplina);
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>
