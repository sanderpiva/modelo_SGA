<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web Consulta Prova</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Prova</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID prova</th>
                <th>Codigo Prova</th>
                <th>Tipo</th>
                <th>Disciplina</th>
                <th>Conteudo</th>
                <th>Data</th>
                <th>Professor</th>
                <th>ID disciplina</th>
                <th>ID professor</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../conexao.php'; // Inclui o arquivo de conexão

            // Assumindo que a tabela se chama 'prova' e as colunas correspondem aos campos do formulário
            $sql = "SELECT id_prova, codigoProva, tipo_prova, disciplina, conteudo, data_prova, professor, Disciplina_id_disciplina, Disciplina_Professor_id_professor FROM prova"; // Explicitando colunas
            $res = mysqli_query($conn, $sql);

             if ($res === false) {
                 echo "<tr><td colspan='8'>Erro ao consultar provas: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
             } elseif (mysqli_num_rows($res) > 0) {
                 // Usando fetch_assoc para clareza e robustez com nomes de colunas
                 while ($reg = mysqli_fetch_assoc($res)) {
                     $id_prova = $reg['id_prova'];
                     $codigoProva = $reg['codigoProva'];
                     $tipoProva = $reg['tipo_prova'];
                     $disciplinaProva = $reg['disciplina'];
                     $conteudoProva = $reg['conteudo'];
                     $dataProva = $reg['data_prova'];
                     $professor = $reg['professor'];
                     $id_disciplina = $reg['Disciplina_id_disciplina'];
                     $id_professor = $reg['Disciplina_Professor_id_professor'];
                     echo "<tr>";
                     echo "<td>" . htmlspecialchars($id_prova) . "</td>";
                     echo "<td>" . htmlspecialchars($codigoProva) . "</td>";
                     echo "<td>" . htmlspecialchars($tipoProva) . "</td>";
                     echo "<td>" . htmlspecialchars($disciplinaProva) . "</td>";
                     echo "<td>" . htmlspecialchars($conteudoProva) . "</td>";
                     echo "<td>" . htmlspecialchars($dataProva) . "</td>";
                     echo "<td>" . htmlspecialchars($professor) . "</td>";
                      // Exibe o novo campo
                     echo "<td>" . htmlspecialchars($id_disciplina) . "</td>";
                     echo "<td>" . htmlspecialchars($id_professor) . "</td>";

                     echo "<td id='buttons-wrapper'>";
                     // Chama a função JS passando o código da prova
                     echo "<button onclick='atualizarProva(\"" . htmlspecialchars($id_prova) . "\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                     echo "<button onclick='excluirProva(\"" . htmlspecialchars($id_prova) . "\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                     echo "</td>";
                     echo "</tr>";
                 }
             } else {
                  echo "<tr><td colspan='8'>Nenhuma prova encontrada.</td></tr>"; // Mensagem se não houver provas
             }

            mysqli_close($conn); // Fecha a conexão
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>

    <script>
        function atualizarProva(id_prova) {
            // Redireciona para o formulário de prova (formProva.php), passando o código
            // AJUSTE O CAMINHO ABAIXO conforme a localização REAL de formProva.php
            window.location.href = "../../cadastros/cadastroProva/formProva.php?id_prova=" + id_prova;
        }

        function excluirProva(id_prova) {
            const confirmar = confirm("Tem certeza que deseja excluir o registro de prova: " + codigoProva + "?");
            if (confirmar) {
                // Assume que excluirProva.php está na mesma pasta
                window.location.href = "excluirProva.php?id_prova=" + id_prova;
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>