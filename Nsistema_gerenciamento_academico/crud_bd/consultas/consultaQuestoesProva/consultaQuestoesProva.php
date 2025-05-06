<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Web Consulta Questões Prova</title>
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Questões Prova</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Código Questão</th>
                <th>Descrição Prova</th>
                <th>Tipo Prova</th>
                <th>ID Prova</th>
                <th>ID Disciplina</th>
                <th>ID Professor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../conexao.php';

            try {
                $stmt = $conexao->query("SELECT * FROM questoes");
                $questoes = $stmt->fetchAll();


                foreach ($questoes as $questao) {
                    $id_questaoProva = htmlspecialchars($questao['id_questao']);
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($questao['codigoQuestao']) . "</td>";
                    echo "<td>" . htmlspecialchars($questao['descricao']) . "</td>";
                    echo "<td>" . htmlspecialchars($questao['tipo_prova']) . "</td>";
                    echo "<td>" . htmlspecialchars($questao['Prova_id_prova']) . "</td>";
                    echo "<td>" . htmlspecialchars($questao['Prova_Disciplina_id_disciplina']) . "</td>";
                    echo "<td>" . htmlspecialchars($questao['Prova_Disciplina_Professor_id_professor']) . "</td>";
                    echo "<td id='buttons-wrapper'>";
                    echo "<button onclick='atualizarQuestaoProva(\"$id_questaoProva\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                    echo "<button onclick='excluirQuestaoProva(\"$id_questaoProva\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='8'>Erro ao consultar questões da prova: " . $e->getMessage() . "</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Voltar aos Serviços</a>

    <script>
        function atualizarQuestaoProva(id_questaoProva) {
            // Redireciona para o formulário de edição da questão prova
            window.location.href = "../../cadastros/cadastroQuestoesProva/formQuestoesProva.php?id_questaoProva=" + id_questaoProva;
        }

        function excluirQuestaoProva(id_questaoProva) {
            const confirmar = confirm("Tem certeza que deseja excluir a questão da prova com ID: " + id_questaoProva + "?");
            if (confirmar) {
                // Redireciona para o script de exclusão da questão prova
                window.location.href = "excluirQuestoesProva.php?id_questaoProva=" + id_questaoProva;
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>