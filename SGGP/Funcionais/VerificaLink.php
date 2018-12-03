<?php

    error_reporting(0);
    ini_set(“display_errors”, 0 );

?>

<?php

    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();

    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i');

    $data = $_GET["d"];
    $prontuario = base64_decode($_GET["b"]);

    $busca = "SELECT login ,email, acesso FROM tb_usuarios WHERE login = '".$prontuario."'";

    $resultado = $conexao->query($busca);

    if ($resultado->num_rows > 0) {

          $saida = $resultado->fetch_assoc();
        
          if (!isset($_SESSION)) session_start();
        
          include("ClassUsuario.php");
        
          if($saida["acesso"] == 1){
        
            $busca = "SELECT nome FROM tb_lideres WHERE tipo = 0";
        
            if ($resultado = $conexao->prepare($busca)) {

                $resultado->execute();

                $resultado->bind_result($nome);

                while ($resultado->fetch()) {

                    $lider = new Lider();
                    $lider->CriaSessao($saida["login"], $nome, $saida["email"], 1);

                }

            }
            else {

                printf( "Erro no SQL!");

            }
          }
          else{
              $lider = new Lider();
              $lider->CriaSessao($saida["login"], "Primeiro Acesso", $saida["email"], 0);
          }

    } 
    else {
        echo $prontuario;
        echo "Login inválido!"; exit;
        
    }

    $conexao->close();


    if(intval(substr($date, -5, 2))>intval(substr($data, -5, 2))){
        if(intval(substr($data, -2, 2)) < 10){
            session_destroy(); 
            header("Location: ../../Visuais/PaginaInicial.php");
        }
        else if((intval(substr($date, -2, 2))-intval(substr($data, -2, 2))) < 50){
            session_destroy(); 
            header("Location: ../../Visuais/PaginaInicial.php");
        }
        else{

            header("Location: ../../Visuais/TrocaSenha.php");
        }
    }
    else if((intval(substr($date, -2, 2))-intval(substr($data, -2, 2))) < 10){

        header("Location: ../../Visuais/TrocaSenha.php");
    }
    else{
        session_destroy(); 
        header("Location: ../../Visuais/PaginaInicial.php");
    }

?>