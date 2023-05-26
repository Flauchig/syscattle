<?php

ini_set( "session.gc_maxlifetime", 5 );



session_start();
date_default_timezone_set('America/Sao_Paulo');


$hostname = 'localhost'; // nome do servidor de banco de dados
$username = 'root'; // nome de usuário do banco de dados
$password = ''; // senha do banco de dados
$database = 'syscattle'; // nome do banco de dados






try {
    $conexao = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Definir o modo de erro do PDO como exceção

    // Aqui você pode realizar outras configurações, se necessário

} catch (PDOException $e) {
    echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
    exit;
}

 class login {

    public static  $cargos = [
        '0' => 'Suporte',
        '1' => 'Administrador'
     
    ];


    public static function validate($usuario, $senha) {
        // Realize a validação do login aqui
        // Você pode adicionar suas regras de validação personalizadas

        // Exemplo básico de validação: Verificar se o nome de usuário e a senha são iguais
        if ($usuario === $senha) {
            return true; // Login válido
        } else {
            return false; // Login inválido
        }
    }


    public static function logado()
    {
        return isset($_SESSION['login']) ? true : false;
        // É uma forma curta de escrever um if-else em uma única linha.

    }









    

 }





