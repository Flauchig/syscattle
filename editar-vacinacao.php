<?php
include 'config.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-vacinacao'])){
    $id_vacinacao = $_POST['id_vacinacao'];
    $data_vacinacao = $_POST['data_vacinacao'];
    $tipo_vacinacao = $_POST['tipo_vacinacao'];
    $dose = $_POST['dose'];
    $lote_vacina = $_POST['lote_vacina'];
    $fabricante = $_POST['fabricante'];
    $observacao = $_POST['observacao'];
    $fk_animal = $_POST['fk_animal'];
    $fk_lote = $_POST['fk_lote'];
   

$sql_update = $conexao->prepare("UPDATE 
                                    vacinacao
                                SET
                                    data_vacinacao = :data_vacinacao,
                                    tipo_vacinacao = :tipo_vacinacao,
                                    dose = :dose,
                                    lote_vacina = :lote_vacina,
                                    fabricante = :fabricante,
                                    observacao = :observacao,
                                    fk_animal = :fk_animal,
                                    fk_lote = :fk_lote
                                WHERE
                                    id_vacinacao = :id_vacinacao");

$sql_update->bindParam(':id_vacinacao', $id_vacinacao);
$sql_update->bindParam(':data_vacinacao', $data_vacinacao);
$sql_update->bindParam(':tipo_vacinacao', $tipo_vacinacao);
$sql_update->bindParam(':dose', $dose);
$sql_update->bindParam(':lote_vacina', $lote_vacina);
$sql_update->bindParam(':fabricante', $fabricante);
$sql_update->bindParam(':observacao', $observacao);
$sql_update->bindParam(':fk_animal', $fk_animal);
$sql_update->bindParam(':fk_lote', $fk_lote);
$sql_update->execute();

header('location: cadastro-vacinacao.php');
exit();


}







?>