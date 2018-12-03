<?php

    error_reporting(0);
    ini_set(“display_errors”, 0 );

?>

<?php
    if(isset($_GET['erro'])){
        $erro = $_GET['erro'];
        $erro++;
    }
    else{
        $erro = 1; 
    }

    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();

    $senha = $_POST["senha"];

    $senhaHash = hash("sha256", $senha);

    $login = $_POST["login"];

    $busca = "SELECT `login`, `email`, `tipo`, `acesso` FROM `tb_usuarios` WHERE `login` = '".$login."' AND `senha` = '".$senhaHash."'";

    $resultado = $conexao->query($busca);

    if ($resultado->num_rows > 0) {

          $saida = $resultado->fetch_assoc();

          if (!isset($_SESSION)) session_start();

          include("ClassUsuario.php");

          if($saida["tipo"] == 1){
              
              $busca2 = "SELECT nome FROM tb_lideres WHERE lider = '$login'";

              $resultado2 = $conexao->query($busca2);
              
              $saida2 = $resultado2->fetch_assoc();

              $lider = new Lider();
              $lider->CriaSessao($saida["login"], $saida2["nome"], $saida["email"], 0);

          }
          else if($saida["tipo"] == 0){

              $adm = new Adm();
              $adm->CriaSessao($saida["login"], $saida["email"], 1);

          }

        if($saida["acesso"] == 0) {

            header('Location: ../Visuais/PainelPrimeiroAcesso.php');

        }

        else{

             header('Location: ../Visuais/Painel.php');

        }

    } 

    else {

        header('Location: ../Visuais/Login.php?erro='.$erro);

    }     
    
    $conexao->close();

?>
