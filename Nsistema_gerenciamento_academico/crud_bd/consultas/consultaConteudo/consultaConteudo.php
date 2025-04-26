<!DOCTYPE html>
<html>
<head>
    <title>Pagina Web Consulta Conteudo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="servicos_forms">

    <h2>Consulta Conteudo</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Id conteudo</th>
                <th>Codigo Conteudo</th>
                <th>Titulo do conteudo</th>
                <th>Descricao</th>
                <th>Data</th>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Tipo conteudo</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../conexao.php'; // Inclui o arquivo de conexão

            $sql = "SELECT * FROM conteudo";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) { // Verifica se há resultados
                while ($reg = mysqli_fetch_row($res)) {
                    $id_conteudo = $reg[0]; // ID do conteúdo
                    $codigoConteudo = $reg[1];
                    $tituloConteudo = $reg[2];
                    $descricaoConteudo = $reg[3];
                    $dataPostagem = $reg[4];
                    $professor = $reg[5];
                    $disciplina = $reg[6];
                    $tipoConteudo = $reg[7];

                    echo "<tr>";
                    echo "<td>$id_conteudo</td>"; // ID do conteúdo
                    echo "<td>$codigoConteudo</td><td>" . htmlspecialchars($tituloConteudo) . "</td>"; // Use htmlspecialchars para exibir dados com segurança
                    echo "<td>" . htmlspecialchars($descricaoConteudo) . "</td><td>$dataPostagem</td>";
                    echo "<td>" . htmlspecialchars($professor) . "</td><td>" . htmlspecialchars($disciplina) . "</td>";
                    echo "<td>" . htmlspecialchars($tipoConteudo) . "</td>";

                    echo "<td id='buttons-wrapper'>";
                    // Chama a função JS passando o código do conteúdo
                    echo "<button onclick='atualizarConteudo(\"$id_conteudo\")'><i class='fa-solid fa-pen'></i> Atualizar</button>";
                    echo "<button onclick='excluirConteudo(\"$id_conteudo\")'><i class='fa-solid fa-trash'></i> Excluir</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                 echo "<tr><td colspan='8'>Nenhum conteúdo encontrado.</td></tr>"; // Mensagem se não houver conteúdos
            }


            mysqli_close($conn); // Fecha a conexão
            ?>
        </tbody>
    </table>

    <br>
    <a href="../../../servicos_professor/pagina_servicos_professor.php">Servicos</a>

    <script>
        function atualizarConteudo(id_conteudo) {
            // Redireciona para o formulário de conteúdo (formConteudo.php), passando o código
            window.location.href = "../../cadastros/cadastroConteudo/formConteudo.php?id_conteudo=" + id_conteudo;
        }

        function excluirConteudo(id_conteudo) {
            const confirmar = confirm("Tem certeza que deseja excluir o conteúdo: " + id_conteudo + "?");
            if (confirmar) {
                // Assume que excluirConteudo.php está na mesma pasta
                window.location.href = "excluirConteudo.php?id_conteudo=" + id_conteudo;
            }
        }
    </script>
</body>
<footer>
    <p>Desenvolvido por Juliana e Sander</p>
</footer>
</html>