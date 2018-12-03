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
                            $id    = $_POST['id'];
                            
                    
                    ?>
                    
                    <div class="row">
                       
                        <div class="col-12">
                           
                            <div class="card card-body">
                               
                                <h4 class="card-title">Para finalizar sua reunião, preencha os campos:</h4>
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <form name="formCadTecnicos" method="post" action="../Funcionais/AtualizaReuniao.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <div class="form-group" hidden>
                                        <label>Sigla:</label>
                                        <input type="text" class="form-control" name="sigla" value="<?php echo $sigla; ?>" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>ID:</label>
                                        <input type="number" class="form-control" name="id" value="<?php echo $id; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Horário de início (real):</label>
                                        <input type="time" class="form-control" name="horareal_reuniao" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Texto da ATA:</label>
                                        <textarea class="form-control" name="ata_reuniao" style="resize:none;" rows="7" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Docentes participantes:</label><br/>
                                        <?php
                                        $docentesParticipantes = "SELECT id, nome FROM tb_participantes WHERE grupo ='".$sigla."'";
                                        
                                         if ($resultado = $conexao->prepare($docentesParticipantes))  {
                                                    $resultado->execute();
                                                    $resultado->bind_result($id, $nome);
                                                    while ($resultado->fetch()) {
                                                        printf('<input type="checkbox" id="L'.$id.'" name="participantesReuniao[]" value="'.$id.'">'.$nome.'<br>');
                                                        
                                                    }
                                                }
                                                else {
                                                    printf( "Erro no SQL!");
                                                }

                                                $resultado->close();
                                        
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Horário de fim:</label>
                                        <input type="time" class="form-control" name="horafim_reuniao" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Convidados:</label>
                                        <textarea class="form-control" name="conv_reuniao" style="resize:none;" rows="5" ></textarea>
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