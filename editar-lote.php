<?php 
include 'config.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-lote'])){

$id_lote_animal = $_POST['id_lote_animal']; 
$lote = $_POST['lote'];
$data_entrada = $_POST['data_entrada'];
$observacao = $_POST['observacao'];
$fk_potreiro = $_POST['fk_potreiro'];
$fk_fazenda = $_POST['fk_fazenda'];

$sql_update = $conexao->prepare("UPDATE 
                                    lote_animal
                                SET
                                    lote = :lote,
                                    data_entrada = :data_entrada,
                                    observacao = :observacao,
                                    fk_potreiro = :fk_potreiro,
                                    fk_fazenda = :fk_fazenda
                                WHERE
                                id_lote_animal = :id_lote_animal");

$sql_update->bindParam(':id_lote_animal', $id_lote_animal);
$sql_update->bindParam(':lote', $lote);
$sql_update->bindParam(':data_entrada', $data_entrada);
$sql_update->bindParam(':observacao', $observacao);
$sql_update->bindParam(':fk_potreiro', $fk_potreiro);
$sql_update->bindParam(':fk_fazenda', $fk_fazenda);

$sql_update->execute();

header('location: cadastro-lote.php');
exit();


}








?>


