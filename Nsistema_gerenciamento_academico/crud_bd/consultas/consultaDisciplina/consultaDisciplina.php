<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web Consulta Disciplina</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Disciplina</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID disciplina</th>
                <th>Codigo disciplina</th>
                <th>Nome</th>
                <th>Carga horaria</th>
                <th>Professor</th>
                <th>Descricao</th>
                <th>Semestre/Periodo</th>
                <th>ID professor</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../conexao.php'; // Inclui o arquivo de conexão

            // Modifiquei a query SELECT para incluir todas as colunas do seu formulário de cadastro
            // Assumindo que a tabela 'disciplina' possui todas estas colunas
            $sql = "SELECT id_disciplina, codigoDisciplina, nome, carga_horaria, professor, descricao, semestre_periodo, Professor_id_professor FROM disciplina";
            $res = mysqli_query($conn, $sql);

             if ($res === false) {
                 echo "<tr><td colspan='10'>Erro ao consultar disciplinas: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
             } elseif (mysqli_num_rows($res) > 0) {
                 while ($reg = mysqli_fetch_row($res)) {
                     $id_disciplina = $reg[0]; // ID da disciplin
                     $codigoDisciplina = $reg[1];
                     $nomeDisciplina = $reg[2];
                     $carga_horaria = $reg[3];
                     $professor = $reg[4];
                     $descricaoDisciplina = $reg[5];
                     $semestre_periodo = $reg[6];
                     $id_professor = $reg[7]; // Novo campo


                     echo "<tr>";
                     echo "<td>" . htmlspecialchars($id_disciplina) . "</td>";
                     echo "<td>" . htmlspecialchars($codigoDisciplina) . "</td>";
                     echo "<td>" . htmlspecialchars($nomeDisciplina) . "</td>";
                     echo "<td>" . htmlspecialchars($carga_horaria) . "</td>";
                     echo "<td>" . htmlspecialchars($professor) . "</td>";
                     echo "<td>" . htmlspecialchars($descricaoDisciplina) . "</td>";
                     echo "<td>" . htmlspecialchars($semestre_periodo) . "</td>";
                      // Exibe os novos campos
                     echo "<td>" . htmlspecialchars($id_professor) . "</td>";


                     echo "<td id='buttons-wrapper'>";
                     // Chama a função JS passando o código da disciplina
                     echo "<button onclick='atualizarDisciplina(\"" . htmlspecialchars($id_disciplina) . "\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                     echo "<button onclick='excluirDisciplina(\"" . htmlspecialchars($id_disciplina) . "\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                     echo "</td>";
                     echo "</tr>";
                 }
             } else {
                  echo "<tr><td colspan='10'>Nenhuma disciplina encontrada.</td></tr>"; // Mensagem se não houver disciplinas
             }

            mysqli_close($conn); // Fecha a conexão
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>

    <script>
        function atualizarDisciplina(id_disciplina) {
            // Redireciona para o formulário de disciplina (formDisciplina.php), passando o código
            window.location.href = "../../cadastros/cadastroDisciplina/formDisciplina.php?id_disciplina=" + id_disciplina;
        }

        function excluirDisciplina(id_disciplina) {
            const confirmar = confirm("Tem certeza que deseja excluir a disciplina de código: " + id_disciplina + "?");
            if (confirmar) {
                // Assume que excluirDisciplina.php está na mesma pasta
                window.location.href = "excluirDisciplina.php?id_disciplina=" + id_disciplina;
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>