<?php
require_once '../conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_professor'])) {

    $id_professor = $_POST['id_professor'];
    $registroProfessor = $_POST['registroProfessor'];
    $nomeProfessor = $_POST['nomeProfessor'];
    $emailProfessor = $_POST['emailProfessor'];
    $enderecoProfessor = $_POST['enderecoProfessor'];
    $telefoneProfessor = $_POST['telefoneProfessor'];

    $stmt = $conexao->prepare("UPDATE professor SET
                                registroProfessor = :registro,
                                nome = :nome,
                                email = :email,
                                endereco = :endereco,
                                telefone = :telefone
                                WHERE id_professor = :id");

    $stmt->execute([
        ':registro' => $registroProfessor,
        ':nome' => $nomeProfessor,
        ':email' => $emailProfessor,
        ':endereco' => $enderecoProfessor,
        ':telefone' => $telefoneProfessor,
        ':id' => $id_professor
    ]);

    if ($stmt->rowCount() > 0) {
        $message = "Professor com registro " . htmlspecialchars($registroProfessor) . " atualizado com sucesso!";
        header("Location: consultaProfessor.php?message=" . urlencode($message));
        exit(); 
    } else {
        $error = "Erro ao atualizar professor.";
        $pathToForm = '../../cadastros/cadastroProfessor/formProfessor.php';
        header("Location: " . $pathToForm . "?id_professor=" . urlencode($id_professor) . "&erros=" . urlencode($error));
        exit(); 
    }

} else {
    $error = "Requisição inválida para atualização de professor.";
    header("Location: consultaProfessor.php?erros=" . urlencode($error));
    exit();
}
?>