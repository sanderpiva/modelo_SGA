<html>
<head>
    <?php
    // Inicie a sessão para acessar os dados armazenados
    session_start();
    ?>
    <title>Pagina Web - Dashboard Dinamico</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Dashboard Dinamico</h1>

    <?php
    // Verifica se os dados de turma e disciplina estão na sessão
    if (isset($_SESSION['turma_selecionada']) && isset($_SESSION['disciplina_selecionada'])) {
        // Recupera os dados da sessão
        $turma_selecionada = $_SESSION['turma_selecionada'];
        $disciplina_selecionada = $_SESSION['disciplina_selecionada'];

        // Exibe os dados da sessão (opcional, se já não quiser mostrá-los novamente)
        echo "<p>Turma selecionada: " . htmlspecialchars($turma_selecionada) . "</p>";
        echo "<p>Disciplina selecionada: " . htmlspecialchars($disciplina_selecionada) . "</p>";

        $servername = "localhost"; // Geralmente 'localhost' se o banco estiver no mesmo servidor
        $username = "root";
        $password = "";
        $dbname = "gerenciamento_academico_completo"; // Nome do seu banco de dados

        // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            // Em caso de erro na conexão, exibe a mensagem e interrompe a execução
            die("<p style='color:red;'>Erro na conexão com o banco de dados: " . $conn->connect_error . "</p>");
        }

        $sql = "SELECT
                    c.titulo,
                    c.descricao
                FROM
                    disciplina d
                JOIN
                    conteudo c ON d.id_disciplina = c.Disciplina_id_disciplina
                WHERE
                    d.nome = ?"; // <--- ASSUMÇÃO: 'codigoDisciplina' na tabela disciplina
                                              // corresponde ao valor de $disciplina_selecionada (ex: 'matematica').
                                              // Se a sua tabela disciplina usar IDs, e você tiver uma tabela de mapeamento
                                              // ou a coluna for outra, ajuste esta linha.

        // Prepara a declaração para segurança (evitar SQL Injection)
        $stmt = $conn->prepare($sql);

        if ($stmt) {
       
            $stmt->bind_param("s", $disciplina_selecionada);

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h2>Conteúdos Relacionados:</h2>";
                while($row = $result->fetch_assoc()) {
                    echo "<h3>Título: " . htmlspecialchars($row["titulo"]) . "</h3>";
                    echo "<p>Descrição: " . htmlspecialchars($row["descricao"]) . "</p>";
                    echo "<hr>"; // Linha divisória entre conteúdos
                }
            } else {
                // Mensagem caso nenhum conteúdo seja encontrado para a disciplina
                echo "<p>Nenhum conteúdo encontrado para a disciplina selecionada.</p>";
            }

            $stmt->close();
        } else {
            echo "<p style='color:red;'>Erro na preparação da consulta: " . $conn->error . "</p>";
        }

        $conn->close();

       
    } else {
        echo "<p style='color:red;'>Dados da turma e disciplina não encontrados na sessão.</p>";
       
    }
    ?>

    </body>
</html>