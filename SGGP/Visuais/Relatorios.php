<!DOCTYPE html>
<html dir="pag" lang="en">
   
    <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['LiderLogin'])) {

          
            
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
                           
                            <h4 class="page-title">Cadastro de Projetos de Pesquisa</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Projetos de Pesquisa</li>
                                        
                                    </ol>
                                    
                                </nav>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="container-fluid">
                    
                        <?php
                            include("../Funcionais/BuscaGruposAno.php");
                        ?>
                        
                    <script>                         
                        function buscaGruposAno(e){
                           document.querySelector("#grupo_pesquisa").innerHTML = '';
                           var cidade_select = document.querySelector("#grupo_pesquisa");

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
                              document.querySelector("#grupo_pesquisa").innerHTML = '';
                           }
                        }
                        
                    </script>
                    
                    <div class="row">
                       
                        <div class="col-12">
                           
                            <div class="card card-body">
                               
                                <h4 class="card-title">Selecione o relatório:</h4>
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <form name="formCadProjetos" method="post" action="../Visuais/ReltTabelas.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <div class="form-group">
                                        <label for="docenteResponsavel">Ano:</label>
                                        <select class="form-control" id="docenteResponsavel" onchange="buscaGruposAno(this.value)" name="ano" required>
                                        <option value="" selected>Escolha</option>
                                        <?php
                                                    
                                            $busca = "SELECT DISTINCT year(data_inicio) FROM tb_grupospesquisa WHERE situacao = 1 ORDER BY data_inicio";

                                            if ($resultado = $conexao->prepare($busca)) {
                                                $resultado->execute();
                                                $resultado->bind_result($nome);

                                                while ($resultado->fetch()) {
                                                    printf('<option value="'.$nome.'">'.$nome.'</option>');
                                                }

                                            }
                                            else {
                                                printf( "Erro no SQL!");
                                            }

                                        ?>  
                                        </select>
                                    </div>
                                    <div class="form-group" id="dlinha_pesquisa">    
                                           <label for="docenteResponsavel">Grupo de Pesquisa:</label>
                                            <select class="form-control" id="grupo_pesquisa" name="grupo_pesquisa" required>
                                            <option value="" selected>Escolha</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Relatorio">Tipo de Relatório</label>
                                        <select class="form-control" id="relatorio" name="relatorio" required>
                                            <option value="" selected>Escolha</option>
                                            <option value="1">Linhas de Pesquisa</option>
                                            <option value="2">Linhas de pesquisa e os docentes</option>
                                            <option value="3">Docentes</option>
                                            <option value="4">Docentes e suas linhas de pesquisa</option>
                                            <option value="5">Discentes</option>
                                            <option value="6">Discentes e seus orientadores</option>
                                            <option value="7">Discentes e seus orientadores e linhas de pesquisa</option>
                                            <option value="8">Técnicos</option>
                                            <option value="9">Equipamentos</option>
                                            <option value="10">Publicações</option>
                                            <option value="11">Projetos finalizados</option>
                                        </select>
                                    </div>
                                    <input type="submit"  onclick="return validar()" value="Gerar" id="relatorio" class="btn btn-secondary"/>
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