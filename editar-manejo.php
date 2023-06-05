<?php
include 'config.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-manejo'])){
    $id_manejo = $_POST['id_manejo'];
    $data_manutencao = $_POST['data_manutencao'];
    $tipo_manutencao = $_POST['tipo_manutencao'];
    $observacao = $_POST['observacao'];
    $fk_animal = $_POST['fk_animal'];
   

$sql_update = $conexao->prepare("UPDATE 
                                    manejo
                                SET
                                    data_manutencao = :data_manutencao,
                                    tipo_manutencao = :tipo_manutencao,
                                    observacao = :observacao,
                                    fk_animal = :fk_animal
                                WHERE
                                id_manejo = :id_manejo");

$sql_update->bindParam(':id_manejo', $id_manejo);
$sql_update->bindParam(':data_manutencao', $data_manutencao);
$sql_update->bindParam(':tipo_manutencao', $tipo_manutencao);
$sql_update->bindParam(':observacao', $observacao);
$sql_update->bindParam(':fk_animal', $fk_animal);
$sql_update->execute();

header('location: cadastro-manejo.php');
exit();


}







?>