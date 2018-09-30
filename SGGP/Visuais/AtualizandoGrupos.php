<!DOCTYPE html>
<html dir="pag" lang="en">

    <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['AdmLogin']) && !isset($_SESSION['LiderLogin'])) {

          session_destroy();
            
          header("Location: PaginaInicial.php"); exit;

        }


        include("../Uteis/HeadPainel.php");
    
    ?>

    <body>
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
           
            <header class="topbar" data-navbarbg="skin6">
               
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                   
                    <?php
                    
                        include("PartesPainel/MenuSup.php");
                    
                    ?>
                    
                </nav>
                
            </header>
            
            <aside class="left-sidebar" data-sidebarbg="skin5">
                
                 <?php
                
                    include("PartesPainel/MenuLat.php");
                
                ?>
                
            </aside>
            
            <div class="page-wrapper">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-5 align-self-center">
                            <h4 class="page-title">Manutenção dos Grupos de Pesquisa</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex align-items-center justify-content-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">SGGP</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Grupos</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid">
                   <script>
                        function retorna()
                        {
                            var x;
                            var r=confirm("Problemas nos dados informados!");
                            if (r==true)
                            {
                                window.location.href = 'CadGrupo.php';
                            }
                            else
                            {
                                window.location.href = 'CadGrupo.php';
                            }
                            document.getElementById("demo").innerHTML=x;
                        }
                    </script>
                    <?php

                        $data = $_POST['datainicio_grupo'];
                        $nomegrupo = $_POST['nome_grupo'];   
                        $email = $_POST['email_grupo'];
                        $sigla = $_POST['sigla_grupo'];
                        $link = $_POST['link_grupo'];
                        $descricao = $_POST['desc_grupo']; 
                        $sigla_antiga = $_POST['sigla_antiga'];
                    
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

                                $novoNome =  $sigla . '.' . $extensao;

                                // Concatena a pasta com o nome
                                $destino = '../Uteis/Imagens/GruposPesquisa/' . $novoNome;

                                // tenta mover o arquivo para o destino
                                if ( move_uploaded_file ( $arquivo_tmp, $destino ) ) {

                                    $atualiza = "UPDATE `tb_grupospesquisa` 
                                                 SET `situacao` = '1', 
                                                     `nome` = '".$nomegrupo."',
                                                     `sigla` = '".$sigla."',
                                                     `email` = '".$email."', 
                                                     `link` = '".$link."', 
                                                     `descricao` = \"".$descricao."\", 
                                                     `data_inicio` = '".$data."', 
                                                     `logotipo` = '".$destino."' 
                                                 WHERE `sigla` = '".$sigla_antiga."'";
                                   
                                    $resultado = mysqli_query($conexao, $atualiza);

                                    if($resultado){
                                        
                                            echo "<div class=\"row\">
                                                    <div class=\"col-12\">
                                                        <div class=\"card card-body\">
                                                            <center><h4 class=\"card-title\">Atualização realizada com sucesso!</h4></center>
                                                            <a href=\"GerenciandoGrupos.php\" id=\"cad_novo\" class=\"btn btn-secondary\">Voltar aos Grupos</a>
                                                        </div>
                                                    </div>";
                                        
                                            unlink("../Grupos/".$sigla_antiga.".php");
                                            $conteudo = '<!DOCTYPE html>
                                                        <html lang="pt">
                                                        <head>
                                                            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                                                        <title>'.$sigla.'</title>
                                                        </head>
                                                        <frameset rows="100%" border="0"> 
                                                        <?php
                                                            $sigla = "'.$sigla.'";
                                                            if(!isset($_SESSION)) session_start();
                                                            $_SESSION[\'sigla\'] = $sigla;
                                                        ?>
                                                        <frame src="PaginaGrupos.php"> 
                                                        </frameset>
                                                        </html>';
                                        $local = "../Grupos/".$sigla.".php";
                                        file_put_contents($local, $conteudo);
                                        
                                    }
                                    else{

                                        echo "<script>retorna();</script>";

                                    }
                                    

                                }
                                else{

                                    echo "<script>retorna();</script>";

                                }
                            }
                            else{

                                echo "<script>retorna();</script>";

                            }
                        }
                        else{

                            echo echo "<script>retorna();</script>";

                        }
                    $conexao->close();

                    ?>

                </div>
                <footer class="footer text-center">
                    Todos os direitos reservados por SGGP. Desenvolvido por:
                    <a href="">SGGP</a>.
                </footer>
            </div>
        </div>
        
        <?php
        
                include("../Uteis/ScriptsPainel.php");
        
        ?>
        
    </body>

</html>