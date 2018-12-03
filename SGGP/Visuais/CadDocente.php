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
                           
                            <h4 class="page-title">Cadastro de Docentes</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Docente</li>
                                        
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
                    
                        include("../Uteis/ScriptValidaCadDocentes.php");
                    
                        if(isset($_POST['sigla'])){
                            
                             $sigla = $_POST['sigla'];
                    
                    ?>
                    
                    
                    <div class="row">
                       
                        <div class="col-12">
                           
                            <div class="card card-body">
                               
                                <h4 class="card-title">Por favor, preencha as informações abaixo:</h4>
                                 <h5 class="card-subtitle">GRUPO: <?php echo $sigla;?></h5> 
                                <form name="formCadDocentes" method="post" action="../Visuais/GravandoDocente.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                   
                                    <div class="form-group">
                                        <label>Nome:</label>
                                        <input type="text" class="form-control" name="nome_docente" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Link Lattes:</label>
                                        <input type="text" class="form-control" name="link_docente" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formacaoAcademica">Formação Acadêmica:</label>
                                        <select class="form-control" id="formacaoAcademica" name="formacao_academica" required>
                                          <option value="" selected>Selecione</option>
                
                                          <option value="1">Ensino Fundamental</option>
                                          <option value="2">Ensino Médio</option>
                                          <option value="3">Ensino Superior</option>
                                          <option value="4">Especialização</option>
                                          <option value="5">Mestrado</option>
                                          <option value="6">Doutorado</option>
                                        </select>
                                        
                                        <script type="text/javascript">
                                            window.onload = function(){
                                               id('formacaoAcademica').onchange = function(){
                                                   if( this.value == 3 || this.value == 4 || this.value == 5 || this.value == 6 )
                                                       id('dnome_curso').style.display = 'block';
                                                   else
                                                       id('dnome_curso').style.display = 'none';
                                               }
                                            }
                                            function id( el ){
                                               return document.getElementById( el );
                                            }
                                        </script>   
                                    </div>
                                    <div class="form-group" id="dnome_curso" style="display:none">    
                                            <label>Nome do curso:</label>
                                            <input type="text" class="form-control" name="nome_curso" >
                                            <input type="text" class="form-control" name="sigla" value="<?php echo $sigla; ?>" hidden>
                                    </div>  
                                    <div class="form-group" >
                                        <label >Foto:</label>
                                        <input type="file" class="form-control" id="arquivo" name="arquivo" required>  
                                    </div>
                                    <div class="form-group" >
                                        <label >Data de inclusão:</label>
                                        <input type="date" class="form-control" id="data" name="datainc_docente"required> 
                                    </div>
                                    
                                    <div class="form-group">
                                        <label >Linhas de Pesquisa:</label><br/>
                                            <?php
                                                $linhasGrupos = "SELECT lg.codigo_capes, s.nome FROM tb_linhasgrupos as lg, tb_subespecialidades as s WHERE lg.grupo = '".$sigla."' AND s.codigo = lg.codigo_capes";

                                                if ($resultado = $conexao->prepare($linhasGrupos)) {
                                                    $resultado->execute();
                                                    $resultado->bind_result($codigo, $nome);
                                                    while ($resultado->fetch()) {
                                                        printf('<input type="checkbox" id="L'.$codigo.'" onclick="N'.$codigo.'()" name="linhasdocente[]" value="'.$codigo.'">'.$codigo.' - '.$nome.'<br>');
                                                        printf('<script type="text/javascript">
                                                                   function N'.$codigo.'() {
                                                                        var checkBox = document.getElementById("L'.$codigo.'");
                                                                        var div = document.getElementById("D'.$codigo.'");
                                                                        if (checkBox.checked == true){
                                                                            div.style.display = "block";
                                                                        } else {
                                                                           div.style.display = "none";
                                                                        }
                                                                    }
                                                                   
                                                                </script>

                                                                <div class="form-group" id="D'.$codigo.'" style="display:none">    
                                                                    <label>Data de vínculo da linha:</label>
                                                                    <input type="date" class="form-control" name="datavinc_linha[]">
                                                                </div>');
                                                    }
                                                }
                                                else {
                                                    printf( "Erro no SQL!");
                                                }

                                                $resultado->close();

                                            ?>
                                        <br/>
                                        <input type="submit" onclick="return validar()" value="Gravar" id="gravar_docente" class="btn btn-secondary"/>    
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