<!DOCTYPE html>
<html dir="pag" lang="en">
   
    <?php

        if (!isset($_SESSION)) session_start();

        if ( !isset($_SESSION['LiderLogin'])) {

         
            
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
                           
                            <h4 class="page-title">Cadastro de Publicações</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Publicação</li>
                                        
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
                    
                    ?>
                    
                    <div class="row">
                       
                        <div class="col-12">
                           
                            <div class="card card-body">
                               
                                <h4 class="card-title">Deseja adicionar uma publicação com projeto de pesquisa?</h4>
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <form name="formEscolhePublicacao" method="post" action="../Funcionais/AdPublicacao.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                   <div class="form-group" hidden>
                                        <label>Sigla:</label>
                                        <input type="text" class="form-control" name="sigla" value="<?php echo $sigla; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="tipoPublicacao" name="formacao_academica" required>
                                          <option value="">Escolha</option>
                                          <option value="1">SIM</option>
                                          <option value="2">NÃO</option>
                    
                                        </select> 
                                        <script type="text/javascript">
                                            window.onload = function(){
                                               id('tipoPublicacao').onchange = function(){
                                                   if( this.value == 1  ){
                                                       id('comProjeto').style.display = 'block';
                                                       
                                                   }
                                                   else{
                                                       id('comProjeto').style.display = 'none';
                                                   }
                                                   
                                                   if( this.value == 2  ){
                                                       id('semProjeto').style.display = 'block';
                                                   }
                                                   else{
                                                       id('semProjeto').style.display = 'none';
                                                   }
                                               }
                                            }
                                            function id( el ){
                                               return document.getElementById( el );
                                            }
                                        </script>     
                                    </div>
                                    <div class="form-group" id="comProjeto" style="display:none">
                                        <div class="form-group">
                                            <label for="docenteResponsavel">Projeto de Pesquisa:</label>
                                            <select class="form-control" name="projeto_publicacao" >
                                            <option value="" selected>Escolha</option>
                                            <?php

                                                $busca = "SELECT id, titulo FROM tb_projetospesquisa WHERE grupo ='".$sigla."'";

                                                if ($resultado = $conexao->prepare($busca)) {
                                                    $resultado->execute();
                                                    $resultado->bind_result($id, $titulo);

                                                    while ($resultado->fetch()) {
                                                        printf('<option value="'.$id.'">'.$titulo.'</option>');
                                                    }

                                                }
                                                else {
                                                    printf( "Erro no SQL!");
                                                }

                                            ?>  
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Título:</label>
                                            <input type="text" class="form-control" name="titulo_publicacao" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="tipoProjeto">Tipo:</label>
                                            <select class="form-control" name="tipo_publicacao" required>
                                              <option value="" selected>Selecione</option>

                                              <option value="1">Livro</option>
                                              <option value="2">Capítulo de Livro</option>
                                              <option value="3">Anais</option>
                                              <option value="4">Periódicos</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Data:</label>
                                            <input type="date" class="form-control" name="data_publicacao" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="linhaPublicacao">Referência ABNT:</label>
                                            <textarea class="form-control" name="referencia_publicacao" rows="5" placeholder="DOCUSSE, Tiago Alexandre. A história do Processamento Gráfico. 1ª edição. São Paulo, 2018." style="resize: none;" required></textarea>
                                            
                                            <br/> 
                                            <input type="submit" onclick="return validar()" value="Gravar" id="grava_publicacao" class="btn btn-secondary"/>
                                        </div>
                                    </div>
                                </form>
                                   <form name="formEscolhePublicacao" method="post" action="../Funcionais/AdPublicacao.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <!-- FORMULARIO SEM PROJETO ------------------------------------------------------------------------------------------------------------------------ -->
                                    <div class="form-group" id="semProjeto" style="display:none">
                                        <div class="form-group" hidden>
                                            <label>Sigla:</label>
                                            <input type="text" class="form-control" name="sigla" value="<?php echo $sigla; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Título:</label>
                                            <input type="text" class="form-control" name="titulo_publicacao" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="tipoProjeto">Tipo:</label>
                                            <select class="form-control" name="tipo_publicacao" required>
                                              <option value="" selected>Selecione</option>

                                              <option value="1">Livro</option>
                                              <option value="2">Capítulo de Livro</option>
                                              <option value="3">Anais</option>
                                              <option value="4">Periódicos</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Data:</label>
                                            <input type="date" class="form-control" name="data_publicacao" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="docenteResponsavel">Docente:</label>
                                            <select class="form-control" id="docenteResponsavel" onchange="buscaLinhasDocentes(this.value)" name="docente_projeto" >
                                            <option value="" selected>Escolha</option>
                                            <?php

                                                $busca = "SELECT id, nome FROM tb_participantes WHERE tipo = 1 AND grupo ='".$sigla."'";

                                                if ($resultado = $conexao->prepare($busca)) {
                                                    $resultado->execute();
                                                    $resultado->bind_result($id, $nome);

                                                    while ($resultado->fetch()) {
                                                        printf('<option value="'.$id.'">'.$nome.'</option>');
                                                    }

                                                }
                                                else {
                                                    printf( "Erro no SQL!");
                                                }

                                            ?>  
                                            </select>
                                        </div>
                                        
                                        <div class="form-group" id="dlinha_pesquisa">    
                                           <label for="docenteResponsavel">Linha de Pesquisa:</label>
                                            <select class="form-control" id="linha_projeto" name="linha_projeto" >
                                            <option value="" selected>Escolha</option>
                                            </select>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label for="linhaPublicacao">Referência ABNT:</label>
                                            <textarea class="form-control" name="referencia_publicacao" rows="5" placeholder="DOCUSSE, Tiago Alexandre. A história do Processamento Gráfico. 1ª edição. São Paulo, 2018." style="resize: none;" required></textarea>
                                            
                                            <br/> 
                                            <input type="submit" onclick="return validar()" value="Gravar" id="grava_publicacao" class="btn btn-secondary"/>
                                        </div>
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