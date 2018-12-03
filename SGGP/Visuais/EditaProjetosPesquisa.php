<!DOCTYPE html>
<html dir="pag" lang="en">  
<script>

    
function clicalinha(linha){
    document.getElementById("linha_mostra").value = linha;
}

</script>
    <?php

        if (!isset($_SESSION)) session_start();

        if(!isset($_SESSION['LiderLogin'])){
              
            header("Location: Painel.php"); exit;
           
        }


        include("../Uteis/HeadPainel.php");
        include("../Uteis/StyleAutoComplete.php");
    
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
                           
                            <h4 class="page-title">Manutenção dos Projetos de Pesquisa</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Projetos</li>
                                        
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
                    
                     
                        
                        if(isset($_POST['id'])){
                        
                            include("../Uteis/ScriptValidaCadTecnicos.php");
                            $id = $_POST['id'];
                            $sigla = $_POST['sigla'];
                    
                    ?>
                    
                    <div class="row">
                       
                        <div class="col-12">
                           
                            <div class="card card-body">
                               
                                <h4 class="card-title">Por favor, preencha as informações abaixo:</h4>
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <form name="formCadProjetos" method="post" action="../Funcionais/EditaProjetos.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <div class="form-group" hidden>
                                        <label>ID:</label>
                                        <input type="text" class="form-control" name="id" value="<?php echo $id; ?>" required>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label >Título:</label>                                  
                                        <?php    
                                        $buscaProjetoDiscente = "SELECT p.*, a.*  FROM tb_projetospesquisa as p INNER JOIN tb_alunos as a
                                                                 ON p.aluno = a.id WHERE p.id=".$id." UNION 
                                        SELECT p.*, a.*  FROM tb_projetospesquisa as p INNER JOIN tb_alunos as a
                                                                 ON a.id = 1 WHERE p.id=".$id;

                                        $resultado = $conexao->query($buscaProjetoDiscente);
                
                    
                                        // VERIFICAÇÃO 
                                        if ($resultado->num_rows > 0) {

                                            $dados = $resultado->fetch_assoc();
                                             printf('<input type="text" class="form-control" id="titulo" name="titulo" maxlength="50" value="'.$dados['titulo'].'">');
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="docenteResponsavel">Docente Responsável:</label>
                                        <select class="form-control" id="docenteResponsavel" onchange="buscaLinhasDocentes(this.value)" name="docente_projeto" required>
                                        <option value="">Escolha</option>
                                        <?php
                                           
                                            $busca = "SELECT id, nome, grupo FROM tb_participantes WHERE grupo ='".$dados['grupo']."'";
                                            
                                            if ($resultado = $conexao->prepare($busca)) {
                                                $resultado->execute();
                                                $resultado->bind_result($id, $nome, $grupo);

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
                                            <option value="">Escolha</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipoBolsa">Tipo de Bolsa:</label>
                                        <select class="form-control" id="tipoBolsa" name="tipo_bolsa" required>
                                          <option value="">Selecione</option>
                                          <option value="Voluntario">Voluntário</option>
                                          <option value="PIBIFSP" title="Programa Institucional de Bolsas de Iniciação Científica e/ou Tecnológica do Instituto Federal de Educação Ciência e Tecnologia de São Paulo">PIBIFSP</option>
                                          <option value="CNPq" title="Conselho Nacional de Desenvolvimento Científico e Tecnológico">CNPq</option>
                                          <option value="Outros">Outros</option>
                                        </select>
                                        
                                        <script type="text/javascript">
                                            document.getElementById('tipoBolsa').value = "<?php echo $dados['tipo']?>";
                                            window.onload = function(){
                                               id('tipoBolsa').onchange = function(){
                                                   if( this.value == "Outros")
                                                       id('dbolsa').style.display = 'block';
                                                   else
                                                       id('dbolsa').style.display = 'none';
                                               }
                                            }
                                            function id( el ){
                                               return document.getElementById( el );
                                            }
                                        </script>   
                                    </div>
                                    <div class="form-group" id="dbolsa" style="display:none">    
                                        <label>Nome/Sigla da Bolsa:</label>
                                        <input type="text" class="form-control" name="outros_bolsa" >
                                    </div>
                                    <div class="form-group">
                                        <label>Data Início:</label>
                                        <input type="date" class="form-control" name="datainicio_proj" value="<?php echo $dados['data_inicio']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                    <?php if($dados['data_fim']!= ""){
                                            printf('
                                            <label>Data Fim:</label>
                                        <input type="date" class="form-control" name="datafim_proj" value="');
                                         if($dados["id"]!= '1'){echo $dados['data_fim'];}
                                            printf('" required>
                                            '
                                            );
                                            
                                        } ?>
                                    </div>
                                    <input type="text" class="form-control" name="sigla" value = "<?php echo $sigla; ?>" hidden required>
                                    <input type="text" class="form-control" name="id_aluno" value = "<?php echo $dados['id']; ?>" hidden required>
                                    <?php if($dados['id']!= 1){
                                    ?>
                                    <hr/>
                                    <h4 class="card-title">Aluno vinculado no Projeto:</h4>
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                    <div class="form-group" >    
                                        <label>Nome do Aluno:</label>
                                        <input type="text" class="form-control" name="nome_aluno" value="<?php if($dados['id']!= '1'){echo $dados['nome'];} ?>" required>
                                    </div>
                                    
                                    <div class="form-group" >  
                                        <label>Curso:</label>
                                        <input type="text" class="form-control" name="curso_aluno" value="<?php if($dados['id']!= '1'){echo $dados['curso'];} ?>" required>
                                    </div>
                                    <div class="form-group">    
                                        <label>Link Lattes:</label>
                                        <input type="text" class="form-control" name="link_aluno" value="<?php if($dados['id']!= '1'){echo $dados['link'];} ?>" required>
                                    </div>
                                    <div class="form-group">    
                                        <label>Início da Orientação:</label>
                                        <input type="date" class="form-control" name="datainicio_aluno" value="<?php if($dados['id']!= '1'){echo $dados['data_inicio'];} ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <?php if($dados['data_fim']!= ""){
                                            printf('
                                            <label>Fim da Orientação:</label>
                                        <input type="date" class="form-control" name="datafim_aluno" value="');
                                         if($dados["id"]!= '1'){echo $dados['data_fim'];}
                                            printf('" required>
                                            '
                                            );
                                            
                                        } ?>
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                     <div class="form-group"> 
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
        
        }
    }
            include("../Uteis/ScriptsPainel.php");
        ?>
    </body>
</html>