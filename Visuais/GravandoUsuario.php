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
                            <h4 class="page-title">Cadastro de Usuários</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex align-items-center justify-content-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">SGGP</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Usuário</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid">
                   
                    <?php

                        date_default_timezone_set('America/Sao_Paulo');
                        $data = date('Y-m-d H:i:s');
                        $prontuario = $_POST['prontuario_lider'];
                        $nome       = $_POST['nome_lider'];
                        $email      = $_POST['email_lider'];
                        include("../Funcionais/GeraSenha.php");
                        $palavra  = geraSenha();
                        $mensagem = "Sua senha: ".$palavra;
                        include("../Funcionais/Email.php");
                        enviarEmail($email, $mensagem);
                        
                        if (!empty($error)){
                            echo $error;
                        } 
                    
                        $senhaCrip = hash('sha256', $palavra);
                    
                        $insereUsuarios = "INSERT INTO `tb_usuarios` (`login`, `email`, `senha`, `data`, `tipo`, `acesso`) 
                                                              VALUES ('$prontuario', '$email', '$senhaCrip', '$data', 1, 0);";
                        $insereLideres  = "INSERT INTO `tb_lideres` (`lider`,`nome`)
                                        VALUES ('$prontuario', '$nome');";
                                   

                       if ($conexao->query($insereUsuarios) === TRUE && $conexao->query($insereLideres)) {
                           
                           echo "<div class=\"row\">
                        <div class=\"col-12\">
                            <div class=\"card card-body\">
                                <center><h4 class=\"card-title\">Cadastro realizado com sucesso!</h4></center>
                                <a href=\"CadUsuario.php\" id=\"cad_novo\" class=\"btn btn-secondary\">Novo Cadastro</a>
                            </div>
                        </div>";
                           
                       }
                        
                        else {
                        
                            echo "Erro ao tentar salvar: " . $conexao->error;
                        
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