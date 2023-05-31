<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-potreiro'])) {
    $id_potreiro = $_POST['id_potreiro'];
    $nome = $_POST['nome'];
    $tamanho = $_POST['tamanho'];
    $capacidade = $_POST['capacidade'];
    $tipo_pasto = $_POST['tipo_pasto'];
    $fk_fazenda = $_POST['fk_fazenda'];

    $sql_update = $conexao->prepare("UPDATE potreiro
                                    SET
                                        nome = :nome,
                                        tamanho = :tamanho,
                                        capacidade = :capacidade,
                                        tipo_pasto = :tipo_pasto,
                                        fk_fazenda = :fk_fazenda
                                        
                                    WHERE id_potreiro = :id_potreiro");
    
    $sql_update->bindParam(':nome', $nome);
    $sql_update->bindParam(':tamanho', $tamanho);
    $sql_update->bindParam(':capacidade', $capacidade);
    $sql_update->bindParam(':tipo_pasto', $tipo_pasto);
    $sql_update->bindParam(':fk_fazenda', $fk_fazenda);
    $sql_update->bindParam(':id_potreiro', $id_potreiro);

    $sql_update->execute();

    header('location: cadastro-potreiro.php');
    exit();
}
?>
