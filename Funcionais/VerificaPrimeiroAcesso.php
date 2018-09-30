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

              $lider = new Lider();
              $lider->CriaSessao($saida["login"], "nome", $saida["email"], 1);

          }
          else if($saida["tipo"] == 0){

              $adm = new Adm();
              $adm->CriaSessao($saida["login"], $saida["email"], 0);

          }

        if($saida["acesso"] == 0) {

            $atualiza = "UPDATE tb_usuarios SET acesso = 1 WHERE login = '$login'";

            $conexao->query($atualiza);

            header('Location: ../Visuais/PainelPrimeiroAcesso.php');

        }

        else{

             header('Location: ../Visuais/Painel.php');

        }

    } 

    else {

        header('Location: ../Visuais/Login.php?erro='.$erro);exit;

    }     
    
    $conexao->close();

?>
