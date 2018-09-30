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

        </div>
        
        <div class="container-fluid">

                <div class="row">
                    
                    <div class="col-12" style="padding-left: 30%; padding-right: 30%">
                        
                        <div class="card card-body">
                            
                            <h4 class="card-title">Atualize seus dados</h4>
                            
                            <form class="form-horizontal m-t-30" enctype="multipart/form-data" action="../Funcionais/AtualizaPALider.php" method="post">
                                
                                <div class="form-group">
                                    
                                    <label>Nova Senha</label>
                                    
                                    <input type="password" class="form-control" placeholder="Senha" id="senha" name="senha">
                                    
                                </div>
                                
                                <div class="form-group">
                                    
                                    <label>Repita a Senha</label>
                                    
                                    <input type="password" class="form-control" placeholder="Confirmar a Senha" id="confsenha" name="confsenha">
                                    
                                </div>
                                
                                <div class="form-group">
                                    
                                    <label>Link Lattes</label>
                                    
                                    <input type="text" class="form-control" placeholder="Link Lattes" name="link">
                                    
                                </div>
                                
                                <div class="form-group">
                                    
                                    <label>Carregue uma foto</label>
                                    
                                    <input type="file" class="form-control" name="arquivo">
                                    
                                </div>
                                
                                <div class="form-group">
                                    
                                    <button type="submit" class="form-control btn btn-outline-primary">Confirma</button>
                                    
                                </div>
                                
                            </form>
                            
                        </div>
                        
                    </div>
                    
                </div>

            </div>
        
        <?php

            include("../Uteis/ScriptsPainel.php");

        ?>
        
    </body>
    
</html>