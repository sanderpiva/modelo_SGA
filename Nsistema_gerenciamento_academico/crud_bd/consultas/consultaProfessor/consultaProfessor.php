<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web Consulta Professor</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="servicos_forms">

    <h2>Consulta Professor</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID professor</th>
                <th>Registro</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Endereco</th>
                <th>Telefone</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../conexao.php'; // Inclui o arquivo de conexão

            // Explicitando as colunas que correspondem aos campos do formulário de cadastro
            // Assumindo que a tabela 'professor' possui todas estas colunas
            $sql = "SELECT id_professor, registroProfessor, nome, email, endereco, telefone FROM professor";
            $res = mysqli_query($conn, $sql);

             if ($res === false) {
                 echo "<tr><td colspan='10'>Erro ao consultar professores: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
             } elseif (mysqli_num_rows($res) > 0) {
                 // Usando fetch_assoc para clareza e robustez com nomes de colunas
                 while ($reg = mysqli_fetch_assoc($res)) {
                     $id_professor = $reg['id_professor'];
                     $registroProfessor = $reg['registroProfessor'];
                     $nomeProfessor = $reg['nome'];
                     $emailProfessor = $reg['email'];
                     $enderecoProfessor = $reg['endereco'];
                     $telefoneProfessor = $reg['telefone'];
                     
                     echo "<tr>";
                     echo "<td>" . htmlspecialchars($id_professor) . "</td>";   
                     echo "<td>" . htmlspecialchars($registroProfessor) . "</td>";
                     echo "<td>" . htmlspecialchars($nomeProfessor) . "</td>";
                     echo "<td>" . htmlspecialchars($emailProfessor) . "</td>";
                     echo "<td>" . htmlspecialchars($enderecoProfessor) . "</td>";
                     echo "<td>" . htmlspecialchars($telefoneProfessor) . "</td>";
                     // Exibe os novos campos
                     
                     echo "<td id='buttons-wrapper'>";
                     // Chama a função JS passando o registro do professor
                     echo "<button onclick='atualizarProfessor(\"" . htmlspecialchars($id_professor) . "\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                     echo "<button onclick='excluirProfessor(\"" . htmlspecialchars($id_professor) . "\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                     echo "</td>";
                     echo "</tr>";
                 }
             } else {
                  echo "<tr><td colspan='10'>Nenhum professor encontrado.</td></tr>"; // Mensagem se não houver professores
             }

            mysqli_close($conn); // Fecha a conexão
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>

    <script>
        function atualizarProfessor(id_professor) {
            // Redireciona para o formulário de professor (formProfessor.php), passando o registro
            // AJUSTE O CAMINHO ABAIXO conforme a localização REAL de formProfessor.php
            window.location.href = "../../cadastros/cadastroProfessor/formProfessor.php?id_professor=" + id_professor;
        }

        function excluirProfessor(id_professor) {
            const confirmar = confirm("Tem certeza que deseja excluir o professor: " + id_professor + "?");
            if (confirmar) {
                // Assume que excluirProfessor.php está na mesma pasta
                window.location.href = "excluirProfessor.php?id_professor=" + id_professor;
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>