<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web Consulta Aluno</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Aluno</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID aluno</th>
                <th>Matricula</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Data nascimento</th>
                <th>Endereco</th>
                <th>Cidade</th>
                <th>Telefone</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../conexao.php'; // Inclui o arquivo de conexão com o banco de dados

            $sql = "SELECT * FROM aluno";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) { // Verifica se há resultados antes de iterar
                while ($reg = mysqli_fetch_row($res)) {
                    $id_aluno = $reg[0]; // ID do aluno (não exibido na tabela
                    $matricula = $reg[1];
                    $nome = $reg[2];
                    $cpf = $reg[3];
                    $email = $reg[4];
                    $data = $reg[5];
                    $endereco = $reg[6];
                    $cidade = $reg[7];
                    $telefone = $reg[8];

                    echo "<tr>";
                    echo "<td>$id_aluno</td>"; // ID do aluno (não exibido na tabela)
                    echo "<td>$matricula</td><td>$nome</td>";
                    echo "<td>$cpf</td><td>$email</td>";
                    echo "<td>$data</td><td>$endereco</td>";
                    echo "<td>$cidade</td><td>$telefone</td>";

                    echo "<td id='buttons-wrapper'>";
                    // Passa a matrícula para o script do formulário (formAluno.php)
                    echo "<button onclick='atualizarRegistro(\"$id_aluno\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                    echo "<button onclick='excluirRegistro(\"$id_aluno\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Nenhum aluno encontrado.</td></tr>"; // Mensagem se não houver alunos
            }


            mysqli_close($conn); // Fecha a conexão com o banco de dados
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>

    <script>
        function atualizarRegistro(id_aluno) {
            // Redireciona para o formulário de aluno, passando a matrícula para indicar atualização
            window.location.href = "../../cadastros/cadastroAluno/formAluno.php?id_aluno=" + id_aluno;
        }

        function excluirRegistro(id_aluno) {
            const confirmar = confirm("Tem certeza que deseja excluir o registro de matricula: " + id_aluno + "?");
            if (confirmar) {
                // Assume que excluirAluno.php está na mesma pasta
                window.location.href = "excluirAluno.php?id_aluno=" + id_aluno;
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>