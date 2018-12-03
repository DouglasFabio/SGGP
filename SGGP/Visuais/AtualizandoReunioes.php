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
                            <h4 class="page-title">Manutenção de Reuniões</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex align-items-center justify-content-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">SGGP</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Reuniões</li>
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
                    
                        date_default_timezone_set('America/Sao_Paulo');
                        $id = $_POST['id'];
                        $inicio_real = $_POST['horareal_reuniao'];
                        $ata = $_POST['ata_reuniao'];   
                        $participantes = $_POST['participantesReuniao'];
                        $sigla = $_POST['sigla'];
                        $fim = $_POST['horafim_reuniao'];
                        $convidados = $_POST['conv_reuniao'];

                        
                        $qtdLinhasSelecionadas = 0;
                        // Verificando quantos participantes foram selecionados
                        foreach($participantes as $k => $v){ 
                            $qtdLinhasSelecionadas++;  
                        }
                        
                        // atualizando sem linha de pesquisa
                        $atualiza = "UPDATE `tb_reunioes` 
                                                 SET `situacao` = '2', 
                                                     `inicio_real` = '".$inicio_real."',
                                                     `ATA` = '".$ata."',
                                                     `fim_reuniao` = '".$fim."', 
                                                     `convidados` = '".$convidados."' 
                                                 WHERE `id` = '".$id."'";

                                    $resultado = mysqli_query($conexao, $atualiza);

                                    if($resultado){

                                            echo "<div class=\"row\">
                                                    <div class=\"col-12\">
                                                        <div class=\"card card-body\">
                                                            <center><h4 class=\"card-title\">Atualização realizada com sucesso!</h4></center>
                                                            <a href=\"Painel.php\" id=\"cad_novo\" class=\"btn btn-secondary\">Voltar aos Grupos</a>
                                                        </div>
                                                    </div>";
                                    }
                    
                                
                                else{
                                    echo "<script>retorna();</script>";
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