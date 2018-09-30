<?php

    error_reporting(0);
    ini_set(“display_errors”, 0 );

    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['AdmLogin']) && !isset($_SESSION['LiderLogin'])) {

      session_destroy();
            
      header("Location: PaginaInicial.php"); exit;

    }

?>

<?php

    $senha1 = $_POST['senha'];
    $senhaHash = hash("sha256", $senha1);
    $senha2 = $_POST['confsenha'];
    $link = $_POST['link'];

    include("../BancoDeDados/Conexao.php");

    $conexao = conectar();

    if($senha1 == $senha2){
        
        if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {

            $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
            $nome = $_FILES[ 'arquivo' ][ 'name' ];

            $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

            // Converte a extensão para minúsculo
            $extensao = strtolower ( $extensao );

            // Somente imagens, .jpg;.jpeg;.gif;.png
            // Aqui eu enfileiro as extensões permitidas e separo por ';'
            // Isso serve apenas para eu poder pesquisar dentro desta String
            if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {

                $novoNome =  $_SESSION['LiderLogin'] . '.' . $extensao;

                // Concatena a pasta com o nome
                $destino = '../Uteis/Imagens/Lideres/' . $novoNome;

                // tenta mover o arquivo para o destino
                if ( move_uploaded_file ( $arquivo_tmp, $destino ) ) {

                    $atualiza = "UPDATE `tb_lideres` SET `link` = '".$link."', `foto` = '".$destino."' WHERE `lider` = '".$_SESSION['LiderLogin']."'";

                    $resultado = mysqli_query($conexao, $atualiza);

                    if($resultado){

                        $atualiza2 = "UPDATE `tb_usuarios` SET `senha` = '".$senhaHash."' WHERE `login` = '".$_SESSION['LiderLogin']."'";

                        $resultado2 = mysqli_query($conexao, $atualiza2);

                        if($resultado2){

                            header('Location: ../Visuais/Painel.php');

                        }


                        else {

                            echo "Falha";

                        }

                    }
                    else{

                        echo "Falha";

                    }

                }
                else{
                    
                    echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
                    
                }
            }
            else{
                
                echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
                
            }
        }
        else{
            
            echo 'Você não enviou nenhum arquivo!';
            
        }
    }
    else{
        
        echo "Falha";
        
    }
?>
