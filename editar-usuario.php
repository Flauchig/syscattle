<?php
include 'config.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-usuario'])){
    $id_login = $_POST['id_login'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $cargo = $_POST['cargo'];
    
   

$sql_update = $conexao->prepare("UPDATE 
                                    login 
                                SET
                                    usuario = :usuario,
                                    senha = :senha,
                                    cargo = :cargo
                                   
                                WHERE
                                id_login = :id_login");

$sql_update->bindParam(':id_login', $id_login);
$sql_update->bindParam(':usuario', $usuario);
$sql_update->bindParam(':senha', $senha);
$sql_update->bindParam(':cargo', $cargo);
$sql_update->execute();

header('location: cadastro-usuario.php');
exit();


}







?>