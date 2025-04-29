<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web Consulta Turma</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Turma</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID turma</th>
                <th>Código Turma</th>
                <th>Nome Turma</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../conexao.php'; // Inclui o arquivo de conexão

            // Assumindo que a tabela se chama 'turma' e as colunas correspondem aos campos do formulário
            $sql = "SELECT * FROM turma"; // Explicitando colunas
            $res = mysqli_query($conn, $sql);

             if ($res === false) {
                 echo "<tr><td colspan='5'>Erro ao consultar turmas: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
             } elseif (mysqli_num_rows($res) > 0) {
                 // Usando fetch_assoc para clareza e robustez com nomes de colunas
                 while ($reg = mysqli_fetch_assoc($res)) {
                     $id_turma = $reg['id_turma'];
                     $codigoTurma = $reg['codigoTurma'];
                     $nomeTurma = $reg['nomeTurma'];
                
                     echo "<tr>";
                     echo "<td>" . htmlspecialchars($id_turma) . "</td>";
                     echo "<td>" . htmlspecialchars($codigoTurma) . "</td>";
                     echo "<td>" . htmlspecialchars($nomeTurma) . "</td>";
                     echo "<td id='buttons-wrapper'>";
                     // Chama a função JS passando o código da turma
                     echo "<button onclick='atualizarTurma(\"" . htmlspecialchars($id_turma) . "\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                     echo "<button onclick='excluirTurma(\"" . htmlspecialchars($id_turma) . "\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                     echo "</td>";
                     echo "</tr>";
                 }
             } else {
                  echo "<tr><td colspan='5'>Nenhuma turma encontrada.</td></tr>"; // Mensagem se não houver turmas
             }

            mysqli_close($conn); // Fecha a conexão
            ?>
        </tbody>
    </table>

    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>

    <script>
        function atualizarTurma(id_turma) {
            // Redireciona para o formulário de turma (formTurma.php), passando o código
            // AJUSTE O CAMINHO ABAIXO conforme a localização REAL de formTurma.php
            window.location.href = "../../cadastros/cadastroTurma/formTurma.php?id_turma=" + id_turma;
        }

        function excluirTurma(id_turma) {
            const confirmar = confirm("Tem certeza que deseja excluir o registro de turma: " + id_turma + "?");
            if (confirmar) {
                // Assume que excluirTurma.php está na mesma pasta
                window.location.href = "excluirTurma.php?id_turma=" + id_turma;
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>