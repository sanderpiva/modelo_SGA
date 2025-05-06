<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Web Consulta Prova</title>
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
          integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Prova</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Disciplina</th>
                <th>Conteúdo</th>
                <th>Data</th>
                <th>Professor</th>
                <th>ID Disciplina</th>
                <th>ID Professor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once "../conexao.php";

            try {
                $stmt = $conexao->query("SELECT id_prova, codigoProva, tipo_prova, disciplina, conteudo, data_prova, professor, Disciplina_id_disciplina, Disciplina_Professor_id_professor FROM prova");
                $provas = $stmt->fetchAll();

                foreach ($provas as $prova) {
                    $id_prova = htmlspecialchars($prova['id_prova']);
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($prova['codigoProva']) . "</td>";
                    echo "<td>" . htmlspecialchars($prova['tipo_prova']) . "</td>";
                    echo "<td>" . htmlspecialchars($prova['disciplina']) . "</td>";
                    echo "<td>" . htmlspecialchars($prova['conteudo']) . "</td>";
                    echo "<td>" . htmlspecialchars($prova['data_prova']) . "</td>";
                    echo "<td>" . htmlspecialchars($prova['professor']) . "</td>";
                    echo "<td>" . htmlspecialchars($prova['Disciplina_id_disciplina']) . "</td>";
                    echo "<td>" . htmlspecialchars($prova['Disciplina_Professor_id_professor']) . "</td>";
                    echo "<td id='buttons-wrapper'>";
                    echo "<button onclick='atualizarProva(\"$id_prova\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                    echo "<button onclick='excluirProva(\"$id_prova\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='10'>Erro ao consultar provas: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Voltar aos Serviços</a>

    <script>
        function atualizarProva(id_prova) {
            window.location.href = "../../cadastros/cadastroProva/formProva.php?id_prova=" + encodeURIComponent(id_prova);
        }

        function excluirProva(id_prova) {
            const confirmar = confirm("Tem certeza que deseja excluir a prova com ID: " + id_prova + "?");
            if (confirmar) {
                window.location.href = "excluirProva.php?id_prova=" + encodeURIComponent(id_prova);
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>
