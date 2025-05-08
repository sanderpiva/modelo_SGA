<?php

require_once '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoRespostas = $_POST["codigoRespostas"];
    $respostaDada = $_POST["respostaDada"];
    $acertou = $_POST["acertou"];
    $nota = $_POST["nota"];
    $id_questao = $_POST["id_questao"];
    $id_prova = $_POST["id_prova"];
    $id_disciplina = $_POST["id_disciplina"];
    $id_professor = $_POST["id_professor"];

    try {
        $sql = "INSERT INTO respostas (codigoRespostas, respostaDada, acertou, nota, Questoes_id_questao, Questoes_Prova_id_prova, Questoes_Prova_Disciplina_id_disciplina, Questoes_Prova_Disciplina_Professor_id_professor)
                VALUES (:codigoRespostas, :respostaDada, :acertou, :nota, :id_questao, :id_prova, :id_disciplina, :id_professor)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':codigoRespostas' => $codigoRespostas,
            ':respostaDada' => $respostaDada,
            ':acertou' => $acertou,
            ':nota' => $nota,
            ':id_questao' => $id_questao,
            ':id_prova' => $id_prova,
            ':id_disciplina' => $id_disciplina,
            ':id_professor' => $id_professor
        ]);

        echo "<p>Dados inseridos com sucesso!</p>";
        echo '<p><a href="../../../servicos_professor/pagina_servicos_professor.php" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Dashboard</a></p>';

    } catch (PDOException $e) {
        $erro = $e->getMessage();
        echo "<p>Erro ao inserir dados: " . htmlspecialchars($erro) . "</p>";

        if (strpos($erro, 'foreign key constraint fails') !== false) {
            echo "<p style='color: red;'>Erro: Problema com vínculos de chave estrangeira. Verifique se os IDs de questão, prova, disciplina e professor existem.</p>";
        } elseif (strpos($erro, "Column count doesn't match value count") !== false) {
            echo "<p style='color: orange;'>Erro: Insira primeiro os dados de questão de prova e prova.</p>";
        }
        echo '<p><a href="formRespostas.php" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Voltar ao Cadastro</a></p>';
    }

} else {
    echo "<p>Requisição inválida.</p>";
}

?>