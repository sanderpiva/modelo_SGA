<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web Consulta Respostas</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Respostas</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID resposta</th>
                <th>Código Resposta</th>
                <th>Resposta dada</th>
                <th>Acertou?</th>
                <th>Nota</th>
                <th>ID Questao</th>
                <th>ID Prova</th>
                <th>ID Disciplina</th>
                <th>ID Professor</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../conexao.php'; // Inclui o arquivo de conexão

            // Assumindo que a tabela se chama 'respostas' e as colunas correspondem aos campos
            // Assumindo nome da coluna da questão é 'codigoQuestao' (baseado no cabeçalho e variável original)
            $sql = "SELECT id_respostas, codigoRespostas, respostaDada, acertou, nota, Questoes_id_questao, Questoes_Prova_id_prova, Questoes_Prova_Disciplina_id_disciplina, Questoes_Prova_Disciplina_Professor_id_professor FROM respostas"; // Explicitando colunas
            $res = mysqli_query($conn, $sql);

             if ($res === false) {
                 echo "<tr><td colspan='7'>Erro ao consultar respostas: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
             } elseif (mysqli_num_rows($res) > 0) {
                 // Usando fetch_assoc para clareza e robustez com nomes de colunas
                 while ($reg = mysqli_fetch_assoc($res)) {
                     $id_respostas = $reg['id_respostas']; // ID da resposta, se necessário
                     $codigoRespostas = $reg['codigoRespostas'];
                     $respostaDada = $reg['respostaDada'];
                     $acertou = $reg['acertou'];
                     $nota = $reg['nota'];
                     $id_questao = $reg['Questoes_id_questao']; // ID da questão
                     $id_prova = $reg['Questoes_Prova_id_prova']; // ID da prova
                     $id_disciplina = $reg['Questoes_Prova_Disciplina_id_disciplina']; // ID da disciplina
                     $id_professor = $reg['Questoes_Prova_Disciplina_Professor_id_professor']; // ID do professor
                     echo "<tr>";
                     echo "<td>" . htmlspecialchars($id_respostas) . "</td>"; // ID da resposta, se necessário
                     echo "<td>" . htmlspecialchars($codigoRespostas) . "</td>";
                     echo "<td>" . htmlspecialchars($respostaDada) . "</td>";
                     echo "<td>" . ($acertou ? 'Sim' : 'Não') . "</td>"; // Exibe Sim/Não
                     echo "<td>" . htmlspecialchars($nota) . "</td>";
                     echo "<td>" . htmlspecialchars($id_questao) . "</td>";
                     echo "<td>" . htmlspecialchars($id_prova) . "</td>";
                     echo "<td>" . htmlspecialchars($id_disciplina) . "</td>";
                     echo "<td>" . htmlspecialchars($id_professor) . "</td>";

                     echo "<td id='buttons-wrapper'>";
                     // Chama a função JS passando o código da resposta
                     echo "<button onclick='atualizarRespostas(\"" . htmlspecialchars($id_respostas) . "\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                     echo "<button onclick='excluirRespostas(\"" . htmlspecialchars($id_respostas) . "\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                     echo "</td>";
                     echo "</tr>";
                 }
             } else {
                  echo "<tr><td colspan='7'>Nenhuma resposta encontrada.</td></tr>"; // Mensagem se não houver respostas
             }

            mysqli_close($conn); // Fecha a conexão
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>

    <script>
        function atualizarRespostas(id_respostas) {
            // Redireciona para o formulário de respostas (formRespostas.php), passando o código
            // AJUSTE O CAMINHO ABAIXO conforme a localização REAL de formRespostas.php
            window.location.href = "../../cadastros/cadastroRespostas/formRespostas.php?id_respostas=" + id_respostas;
        }

        function excluirRespostas(id_respostas) {
            const confirmar = confirm("Tem certeza que deseja excluir o registro de resposta: " + id_respostas + "?");
            if (confirmar) {
                // Assume que excluirRespostas.php está na mesma pasta
                window.location.href = "excluirRespostas.php?id_respostas=" + id_respostas;
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>