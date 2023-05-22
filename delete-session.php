<?php


include('config.php');

session_start();




//limpa variáveis de sessão
unset( $_SESSION['usuario'] );
unset( $_SESSION['senha'] );

if( !isset( $_SESSION['usuario'] ) )
{
    session_destroy(); 
    header('Location: login.php');
}