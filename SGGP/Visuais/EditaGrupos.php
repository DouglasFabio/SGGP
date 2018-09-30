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

                    <?php
                    
                        include("../Uteis/ScriptValidaInfoGrupos.php");
                    
                    
                    ?>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-body">
                                <h4 class="card-title">Grupo de Pesquisa</h4>
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <form name="formEdCadGrupos" method="post" action="../Visuais/AtualizandoGrupos.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <div class="form-group">
                                        <label >Nome:</label>                                  
                                        <?php
                                            
                                            $sigla = $_POST['sigla'];
                                                    
                                            $busca = "SELECT nome FROM tb_grupospesquisa WHERE sigla='".$sigla."'";

                                            if ($resultado = $conexao->prepare($busca)) {
                                                $resultado->execute();
                                                $resultado->bind_result($nome);

                                                if($resultado->fetch()) {
                                                    printf('<input type="text" class="form-control" id="nome_grupo" name="nome_grupo" maxlength="50" value="'.$nome.'">');
                                                }

                                            }
                                            else {
                                                printf( "Erro no SQL!");
                                            }

                                            $resultado->close();

                                        ?>  
                                    </div>
                                    <div class="form-group">
                                        <label >Sigla:</label>                                  
                                        <?php
                                            
                                            
                                                    
                                            $busca = "SELECT sigla FROM tb_grupospesquisa WHERE sigla='".$sigla."'";

                                            if ($resultado = $conexao->prepare($busca)) {
                                                $resultado->execute();
                                                $resultado->bind_result($sigla);

                                                if($resultado->fetch()) {
                                                    printf('<input type="text" class="form-control" id="sigla_grupo" name="sigla_grupo" maxlength="10" value="'.$sigla.'">');
                                                }

                                            }
                                            else {
                                                printf( "Erro no SQL!");
                                            }

                                            $resultado->close();

                                        ?>  
                                    </div>
                                     <div class="form-group" hidden>
                                        <label >Sigla Antiga:</label>                                  
                                        <?php
                                            
                                                    
                                            $busca = "SELECT sigla FROM tb_grupospesquisa WHERE sigla='".$sigla."'";

                                            if ($resultado = $conexao->prepare($busca)) {
                                                $resultado->execute();
                                                $resultado->bind_result($sigla);

                                                if($resultado->fetch()) {
                                                    printf('<input type="text" class="form-control" id="sigla_antiga" name="sigla_antiga" value="'.$sigla.'">');
                                                }

                                            }
                                            else {
                                                printf( "Erro no SQL!");
                                            }

                                            $resultado->close();

                                        ?>  
                                    </div>
                                     <div class="form-group"> 
                                        <label>Email do Grupo:</label>
                                        <input type="email" class="form-control" id="email_grupo" name="email_grupo" maxlength="50" placeholder="Opcional">  
                                    </div>
                                     <div class="form-group"> 
                                        <label>Link CNPq:</label>
                                        <input type="text" class="form-control" id="link_grupo" name="link_grupo">  
                                    </div>
                                     <div class="form-group"> 
                                        <label>Descrição:</label>
                                        <textarea style="resize: none;" class="form-control" rows="5" id="desc_grupo" name="desc_grupo"></textarea> 
                                    </div>
                                    
                                    <div class="form-group"> 
                                        <label>Logotipo:</label>
                                        <input type="file" class="form-control" id="arquivo" name="arquivo">  
                                    </div>
                                     <div class="form-group"> 
                                        <label>Data de Início:</label>
                                        <input type="month" class="form-control" id="datainicio_grupo" name="datainicio_grupo">  
                                    </div>
                                    <br/>
                                        <input type="submit" onclick="return validar()" value="Gravar" id="gravar_grupo" class="btn btn-secondary"/>
                                </form>                    
                            </div>
                        </div>
                    </div>
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