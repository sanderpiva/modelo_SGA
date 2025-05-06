<?php 
	require_once "../conexao.php";
	if (isset($_GET['id_aluno']) && !empty($_GET['id_aluno'])) {
		$id = $_GET['id_aluno'];

		$stmt = $conexao->prepare("DELETE FROM aluno WHERE id_aluno = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			header("Location: ../../consultas/consultaAluno/consultaAluno.php?excluido=sucesso"); 
			exit;
		} else {
			echo "Erro ao excluir o aluno.";
		}
	} else {
		echo "ID não fornecido.";
	}
?>
