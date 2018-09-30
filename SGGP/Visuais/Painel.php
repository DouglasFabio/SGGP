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
                           
                            <h4 class="page-title">Início</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Início</li>
                                        
                                    </ol>
                                    
                                </nav>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                   
                <div class="row">
                   
                    <div class="col-12">
                       
                        <div class="card">
                           
                            <div class="card-body">
                               
                                <h4 class="card-title">Usuários Cadastrados</h4>
                                
                            </div>
                            
                            <div class="table-responsive">
                              
                                <table class="table table-hover">
                               
                                    <thead>
                                       
                                        <tr>
                                           
                                            <th scope="col">Usuário</th>
                                            <th scope="col">Tipo</th>
                                            
                                        </tr>
                                        
                                    </thead>
                                       
                                        <tbody>
                                               <?php
                                            
                                                    $busca = "SELECT login FROM tb_usuarios WHERE tipo = 0";

                                                    if ($resultado = $conexao->prepare($busca)) {

                                                        $resultado->execute();

                                                        $resultado->bind_result($login);

                                                        while ($resultado->fetch()) {

                                                            printf('<tr><td>'.$login.'</td>
                                                                        <td><span class="label label-rounded label-primary">ADMIN</span></td>
                                                                    </tr>');

                                                        }

                                                    }
                                                    else {

                                                        printf( "Erro no SQL!");

                                                    }

                                                    $resultado->close();
                                                    
                                                ?>
                                        </tbody>
                                        
                                        <tbody>
                                               <?php
                                                    
                                                    $busca2 = "SELECT nome FROM tb_lideres";

                                                    if ($resultado = $conexao->prepare($busca2)) {

                                                        $resultado->execute();

                                                        $resultado->bind_result($nome);

                                                        while ($resultado->fetch()) {
                                                            printf('<tr><td>'.$nome.'</td>
                                                                        <td><span class="label label-success label-rounded">LÍDER</span></td>
                                                                    </tr>');
                                                        }

                                                    }
                                                    else {
                                                        
                                                        printf( "Erro no SQL!");
                                                        
                                                    }

                                                    $resultado->close();
                                                    
                                                ?>
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                    <footer class="footer text-center">
                       
                        Todos os direitos reservados por SGGP. Desenvolvido por:
                        <a href="">SGGP</a>.
                        
                    </footer>
                    
                </div>
            
        <?php

            include("../Uteis/ScriptsPainel.php");

        ?>
            
    </body>
    
</html>