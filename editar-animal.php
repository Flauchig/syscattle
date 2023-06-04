<?php 
include 'config.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-animal'])){
    $id_animal = $_POST['id_animal'];
    $data_nascimento = $_POST['data_nascimento'];
    $brinco = $_POST['brinco'];
    $peso = $_POST['peso'];
    $raca = $_POST['raca'];
    $fk_lote = $_POST['fk_lote'];
    $fk_potreiro = $_POST['fk_potreiro'];

$sql_update = $conexao->prepare("UPDATE 
                                    animal
                                SET
                                    data_nascimento = :data_nascimento,
                                    brinco = :brinco,
                                    peso = :peso,
                                    raca = :raca,
                                    fk_lote = :fk_lote,
                                    fk_potreiro = :fk_potreiro
                                WHERE
                                id_animal = :id_animal");

$sql_update->bindParam(':id_animal', $id_animal);
$sql_update->bindParam(':data_nascimento', $data_nascimento);
$sql_update->bindParam(':brinco', $brinco);
$sql_update->bindParam(':peso', $peso);
$sql_update->bindParam(':raca', $raca);
$sql_update->bindParam(':fk_lote', $fk_lote);
$sql_update->bindParam(':fk_potreiro', $fk_potreiro);

$sql_update->execute();

header('location: cadastro-animais.php');
exit();


}