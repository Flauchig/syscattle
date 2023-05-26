<?php
include('config.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-editar'])) {
  $id_fazenda = $_POST['id_fazenda'];
  $nome_fazenda = $_POST['nome_fazenda'];
  $endereco = $_POST['endereco'];
  $cidade = $_POST['cidade'];
  $estado = $_POST['estado'];
  $cep = $_POST['cep'];
  $telefone = $_POST['telefone'];

  $sql_update = $conexao->prepare("UPDATE fazenda SET nome_fazenda = :nome_fazenda, endereco = :endereco, cidade = :cidade, estado = :estado, cep = :cep, telefone = :telefone WHERE id_fazenda = :id_fazenda");
  $sql_update->bindParam(':nome_fazenda', $nome_fazenda);
  $sql_update->bindParam(':endereco', $endereco);
  $sql_update->bindParam(':cidade', $cidade);
  $sql_update->bindParam(':estado', $estado);
  $sql_update->bindParam(':cep', $cep);
  $sql_update->bindParam(':telefone', $telefone);
  $sql_update->bindParam(':id_fazenda', $id_fazenda);
  $sql_update->execute();

  // Redirecionar para a página principal após a atualização
  header('Location: cadastro-fazenda.php');
  exit();
}
?>


<script>
  $(document).ready(function() {
    $('#cep').inputmask("99999-999");
    $('#telefone').inputmask('(99) 9999-9999');
  });
</script>