<?php
// Inclua o arquivo de conexão com o banco de dados
include 'config.php';

// Verifique se o ID da fazenda foi fornecido na URL
if (isset($_GET['id'])) {
  // Obtenha o ID da fazenda a ser excluída
  $idlote = $_GET['id'];

  // Prepare a consulta SQL para excluir a fazenda
  $consulta = $conexao->prepare("DELETE FROM lote_animal WHERE id_lote_animal = :id");
  $consulta->bindValue(':id', $idlote);

  // Execute a consulta
  if ($consulta->execute()) {
    // Redirecione para a página de cadastro de fazendas após a exclusão
    header("Location: cadastro-lote.php");
    exit; // Certifique-se de sair do script após redirecionar
  } else {
    echo "Erro ao excluir a fazenda: " . $consulta->errorInfo();
  }
}
?>
