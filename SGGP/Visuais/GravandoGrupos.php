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
                            <h4 class="page-title">Cadastro de Grupos de Pesquisa</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex align-items-center justify-content-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">SGGP</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Grupos de Pesquisa</li>
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

                        $nome        = $_POST['nome_grupo'];
                        $sigla       = $_POST['sigla_grupo'];
                        $lider       = $_POST['lider_grupo'];
                        // CHAVE PRIMARIA DE USUARIOS = LOGIN
                        // CHAVE ESTRANGEIRA DE LIDERES = LIDER
                        $buscaLogin = " SELECT `lider`
                                        FROM `tb_lideres`
                                        WHERE nome = '$lider'";
                        
                        $resultado = $conexao->query($buscaLogin);
                    
                        if ($resultado->num_rows > 0) {
                            $saida = $resultado->fetch_assoc();
                            $buscaEmail = " SELECT `email`
                                    FROM `tb_usuarios`
                                    WHERE `login` = '".$saida["lider"]."'";
                            $resultado2 = $conexao->query($buscaEmail);
                            if ($resultado2->num_rows > 0) {
                                
                                $saida2 = $resultado2->fetch_assoc();
                                
                                $mensagem    = "Lider, por favor acesse o Sistema SGGP e ative seu grupo: ".$nome."!";
                                include("../Funcionais/Email.php");
                                enviarEmail($saida2["email"], $mensagem);

                                $insere = "INSERT INTO `tb_grupospesquisa` (`nome`, `sigla`, `lider`, `situacao`, `email`, `link`, `descricao`, `logotipo`, `data_inicio`) 
                                                                    VALUES ('$nome', '$sigla', '".$saida["lider"]."', '2', NULL, NULL, NULL, NULL, NULL);";

                               if ($conexao->query($insere) === TRUE) {

                                   echo "<div class=\"row\">
                                <div class=\"col-12\">
                                    <div class=\"card card-body\">
                                        <center><h4 class=\"card-title\">Cadastro realizado com sucesso!</h4></center>
                                        <a href=\"CadGrupo.php\" id=\"cad_novo\" class=\"btn btn-secondary\">Novo Cadastro</a>
                                    </div>
                                </div>";
                                   
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


                               }else {
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
                    
                        $resultado->close();
                        $resultado2->close();
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