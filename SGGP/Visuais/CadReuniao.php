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
                           
                            <h4 class="page-title">Cadastro de Reuniões</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Reuniões</li>
                                        
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
                            var r=confirm("Escolha um grupo!");
                            if (r==true)
                            {
                                window.location.href = 'Painel.php';
                            }
                            else
                            {
                                window.location.href = 'Painel.php';
                            }
                            document.getElementById("demo").innerHTML=x;
                        }
                    </script>
                    
                    
                    

                    <?php
                    
                     
                        
                        if(isset($_POST['sigla'])){
                        
                            include("../Uteis/ScriptValidaCadReunioes.php");
                            $sigla = $_POST['sigla'];
                    
                    ?>
                    
                    <div class="row">
                       
                        <div class="col-12">
                           
                            <div class="card card-body">
                               
                                <h4 class="card-title">Por favor, preencha as informações abaixo:</h4>
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <form name="formCadTecnicos" method="post" action="../Funcionais/AdReuniao.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <div class="form-group" hidden>
                                        <label>Sigla:</label>
                                        <input type="text" class="form-control" name="sigla" value="<?php echo $sigla; ?>" required>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Data:</label>
                                        <input type="date" class="form-control" name="data_reuniao" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Horário de início (previsão):</label>
                                        <input type="time" class="form-control" name="horaprev_reuniao" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Pauta:</label>
                                        <textarea class="form-control" name="pauta_reuniao" style="resize:none;" rows="5" required></textarea>
                                        <br/>
                                        <input type="submit" onclick="return validar()" value="Gravar" id="gravar_reuniao" class="btn btn-secondary"/>
                                    </div>
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
        }else{
              echo "<script>retorna();</script>";              
        }
            include("../Uteis/ScriptsPainel.php");

        ?>
        
    </body>

</html>