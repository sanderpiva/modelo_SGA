<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web Consulta Questoes Prova</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Questoes Prova</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID questão prova</th>
                <th>Codigo Questao</th>
                <th>Descricao prova</th>
                <th>Tipo prova</th>
                <th>ID prova</th>
                <th>ID disciplina</th>
                <th>ID professor</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../conexao.php'; // Inclui o arquivo de conexão

            // Assumindo que a tabela se chama 'questoes' e as colunas correspondem aos campos do formulário
            // Usando nomes de colunas como identificamos anteriormente (codigoQuestaoProva, descricao_questao, tipo_prova)
            $sql = "SELECT id_questao, codigoQuestao, descricao, tipo_prova, Prova_id_prova, Prova_Disciplina_id_disciplina, Prova_Disciplina_Professor_id_professor  FROM questoes"; // Explicitando colunas
            $res = mysqli_query($conn, $sql);

             if ($res === false) {
                 echo "<tr><td colspan='8'>Erro ao consultar questões: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
             } elseif (mysqli_num_rows($res) > 0) {
                 // Usando fetch_assoc para clareza e robustez com nomes de colunas
                 while ($reg = mysqli_fetch_assoc($res)) {
                     $id_questaoProva = $reg['id_questao']; // ID da questão prova
                     $codigoQuestaoProva = $reg['codigoQuestao'];
                     $descricaoProva = $reg['descricao']; // Usando a chave correta 'descricao_questao'
                     $tipoProva = $reg['tipo_prova']; // Usando a chave correta 'tipo_prova'
                     $id_prova = $reg['Prova_id_prova']; // ID da prova
                     $id_disciplina = $reg['Prova_Disciplina_id_disciplina']; // ID da disciplina
                     $id_professor = $reg['Prova_Disciplina_Professor_id_professor']; // ID do conteúdo
                     echo "<tr>";
                     echo "<td>" . htmlspecialchars($id_questaoProva) . "</td>"; // ID da questão prova
                     echo "<td>" . htmlspecialchars($codigoQuestaoProva) . "</td>";
                     echo "<td>" . htmlspecialchars($descricaoProva) . "</td>";
                     echo "<td>" . htmlspecialchars($tipoProva) . "</td>";
                     echo "<td>" . htmlspecialchars($id_prova) . "</td>";   
                     echo "<td>" . htmlspecialchars($id_disciplina) . "</td>";
                     echo "<td>" . htmlspecialchars($id_professor) . "</td>";
                     echo "<td id='buttons-wrapper'>";
                     // Chama a função JS passando o código da questão prova
                     // APONTANDO PARA formQuestoesProva.php (PLURAL)
                     echo "<button onclick='atualizarQuestaoProva(\"" . htmlspecialchars($id_questaoProva) . "\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                     echo "<button onclick='excluirQuestaoProva(\"" . htmlspecialchars($id_questaoProva) . "\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                     echo "</td>";
                     echo "</tr>";
                 }
             } else {
                  echo "<tr><td colspan='8'>Nenhuma questão de prova encontrada.</td></tr>"; // Mensagem se não houver questões
             }

            mysqli_close($conn); // Fecha a conexão
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>

    <script>
        function atualizarQuestaoProva(id_questaoProva) {
            // Redireciona para o formulário de questão prova (formQuestoesProva.php - PLURAL), passando o código
            // AJUSTE O CAMINHO ABAIXO conforme a localização REAL de formQuestoesProva.php
            window.location.href = "../../cadastros/cadastroQuestoesProva/formQuestoesProva.php?id_questaoProva=" + id_questaoProva;
        }

        function excluirQuestaoProva(id_questaoProva) {
            const confirmar = confirm("Tem certeza que deseja excluir o registro de questão prova: " + id_questaoProva + "?");
            if (confirmar) {
                // Assume que excluirQuestoesProva.php (PLURAL) está na mesma pasta
                window.location.href = "excluirQuestoesProva.php?id_questaoProva=" + id_questaoProva;
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>