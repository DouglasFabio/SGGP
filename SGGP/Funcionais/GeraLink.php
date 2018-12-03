<?php

    error_reporting(0);
    ini_set(“display_errors”, 0 );

?>

<?php

    include("../Funcionais/Email.php");

    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();

    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i');

    $prontuario = $_POST['prontuario'];

    $busca = "SELECT email, senha FROM tb_usuarios WHERE login ='$prontuario'";

    $resultado = $conexao->query($busca);

    if ($resultado->num_rows > 0) {

        $saida = $resultado->fetch_assoc();
        
        $mensagem = "Olá<br>Para recuperar sua senha <a href='localhost/SGGP/Funcionais/VerificaLink.php/?d=".$date."&b=".base64_encode($prontuario)."'>Clique Aqui</a><br> Se você não solicitou a recuperação de senha IGNORE ESTE E-MAIL";
                        
        enviarEmail($saida["email"], $mensagem);
        
        header('Location: ../Visuais/EmailEnviado.php');
        
    }

    else{

        header('Location: ../Visuais/EsqueceuSenha.php?erro=1');

    }

    $conexao->close();

?>