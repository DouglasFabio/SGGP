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
                           
                            <h4 class="page-title">Cadastro de Discentes</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Discente</li>
                                        
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
                            var r=confirm("Escolha um projeto!");
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
                            include("../Funcionais/BuscaLinhasDocentes.php");
                        ?>
                        
                    <script>                         
                        function buscaLinhasDocentes(e){
                           document.querySelector("#linha_projeto").innerHTML = '';
                           var cidade_select = document.querySelector("#linha_projeto");

                           var num_estados = json_cidades.estados.length;
                           var j_index = -1;

                           // aqui eu pego o index do Estado dentro do JSON
                           for(var x=0;x<num_estados;x++){
                              if(json_cidades.estados[x].sigla == e){
                                 j_index = x;
                              }
                           }

                           if(j_index != -1){

                              // aqui eu percorro todas as cidades e crio os OPTIONS
                              json_cidades.estados[j_index].cidades.forEach(function(cidade){
                                 var cid_opts = document.createElement('option');
                                 cid_opts.setAttribute('value',cidade)
                                 cid_opts.innerHTML = cidade;
                                 cidade_select.appendChild(cid_opts);
                              });
                           }else{
                              document.querySelector("#linha_projeto").innerHTML = '';
                           }
                        }
                        
                    </script>
                    
                    
                    

                    <?php
                        
                        if(isset($_POST['sigla'])){
                        
                            include("../Uteis/ScriptValidaCadTecnicos.php");
                            $sigla = $_POST['sigla'];
                            $id = $_POST['id'];
                            $titulo = $_POST['titulo'];
                    ?>
                    
                    <div class="row">
                       
                        <div class="col-12">
                           
                            <div class="card card-body">
                               
                                <h4 class="card-title">Aluno sendo vinculado no Projeto: <?php echo $titulo; ?></h4>
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <form name="formCadProjetos" method="post" action="../Funcionais/AdDiscente.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <div class="form-group" >    
                                        <label>Nome do Aluno:</label>
                                        <input type="text" class="form-control" name="nome_aluno" required>
                                    </div>
                                    <input type="text" class="form-control" name="sigla" value = "<?php echo $sigla; ?>" hidden required>
                                    <input type="text" class="form-control" name="id" value = "<?php echo $id; ?>" hidden required>
                                    <div class="form-group">    
                                        <label>Curso:</label>
                                        <input type="text" class="form-control" name="curso_aluno" required>
                                    </div>
                                    <div class="form-group">    
                                        <label>Link Lattes:</label>
                                        <input type="text" class="form-control" name="link_aluno" required>
                                    </div>
                                    <div class="form-group">    
                                        <label>Início da Orientação:</label>
                                        <input type="date" class="form-control" name="datainicio_aluno" required>
                                         <br/>
                                        <input type="submit" onclick="return validar()" value="Gravar" id="gravar_discente" class="btn btn-secondary"/>
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