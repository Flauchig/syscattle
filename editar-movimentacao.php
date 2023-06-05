<?php
include 'config.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-movimentacao'])){
    $id_movimentacao = $_POST['id_movimentacao'];
    $data_movimentacao = $_POST['data_movimentacao'];
    $tipo_movimentacao = $_POST['tipo_movimentacao'];
    $observacao = $_POST['observacao'];
    $fk_animal = $_POST['fk_animal'];
   

$sql_update = $conexao->prepare("UPDATE 
                                    movimentacao
                                SET
                                    data_movimentacao = :data_movimentacao,
                                    tipo_movimentacao = :tipo_movimentacao,
                                    observacao = :observacao,
                                    fk_animal = :fk_animal
                                WHERE
                                id_movimentacao = :id_movimentacao");

$sql_update->bindParam(':id_movimentacao', $id_movimentacao);
$sql_update->bindParam(':data_movimentacao', $data_movimentacao);
$sql_update->bindParam(':tipo_movimentacao', $tipo_movimentacao);
$sql_update->bindParam(':observacao', $observacao);
$sql_update->bindParam(':fk_animal', $fk_animal);
$sql_update->execute();

header('location: cadastro-movimentacao.php');
exit();


}







?>
