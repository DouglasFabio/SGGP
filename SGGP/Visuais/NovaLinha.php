<!DOCTYPE html>
<html dir="pag" lang="en">
    <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['AdmLogin'])) {
            
          header("Location: Painel.php"); exit;

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
                           
                            <h4 class="page-title">Manutenção das Linhas de Pesquisa</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Linhas Pesquisa</li>
                                        
                                    </ol>
                                    
                                </nav>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="container-fluid">
                    <?php 
                        include("../Uteis/ScriptValidaNovaLinha.php");
                    ?>
                    
                     <div class="row">
                       
                        <div class="col-12">
                           
                            <div class="card card-body">
                               
                                <h4 class="card-title">Adicionando nova Linha de Pesquisa:</h4>
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <?php
                                    if(!isset($_POST['nome_novo'])){
                                    $linha = $_POST['linha_add']; 
                                ?>
                                <form name="formCadUsuarios" method="post" action="../Visuais/NovaLinha.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                <?php
                                   if($linha == ""){
                                        printf('<input name="id" hidden>');
                                        printf('<input name="tabela" value="tb_grandesareas" hidden>');
                                    }
                                    else{

                                        $busca = "SELECT id, codigo, nome FROM tb_grandesareas WHERE nome = '".$linha."'";

                                        $resultado = $conexao->query($busca);

                                        if ($resultado->num_rows == 0) {
                                                $busca2 = "SELECT id, codigo, nome FROM tb_subareas WHERE nome = '".$linha."'";

                                                $resultado2 = $conexao->query($busca2);
                                                if ($resultado2->num_rows == 0) {
                                                    $busca3 = "SELECT id, codigo, nome FROM tb_especialidades WHERE nome = '".$linha."'";

                                                    $resultado3 = $conexao->query($busca3);
                                                    if ($resultado3->num_rows == 0) {
                                                        
                                                        printf('<script>window.alert("Nível máximo atingido!");</script>');
                                                        
                                                    }
                                                    else{
                                                        $saida = $resultado->fetch_assoc();
                                                        printf('<input name="id" value="'.$saida['id'].'" hidden>');
                                                        printf('<input name="tabela" value="tb_subespecialidades" hidden>');
                                                    }
                                                }
                                                else{
                                                    $saida = $resultado->fetch_assoc();
                                                    printf('<input name="id" value="'.$saida['id'].'" hidden>');
                                                    printf('<input name="tabela" value="tb_especialidades" hidden>');
                                                }
                                        }
                                        else{
                                            $saida = $resultado->fetch_assoc();
                                            printf('<input name="id" value="'.$saida['id'].'" hidden>');
                                            printf('<input name="tabela" value="tb_subareas" hidden>');
                                        }
                                    }
                                    ?>
                                    <div class="form-group">
                                       
                                        <label>Nome da Linha/Área:</label>
                                        
                                        <input type="text" class="form-control" name="nome_novo" >
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                       
                                        <label >Código:</label>
                                        
                                        <input type="number" max="99999999" class="form-control" name="codigo_novo">
                                        
                                        <br/>
                                        
                                        <input type="submit" onclick="return validar()" value="Gravar" id="gravar_lider" class="btn btn-secondary"/>

                                    </div>

                                </form>
                                <?php
                                    }
                                else{
                                    $id = $_POST['id'];
                                    $tabela = $_POST['tabela'];
                                    $nome = $_POST['nome_novo'];
                                    $codigo = $_POST['codigo_novo'];
                                    
                                    if ($tabela == "tb_grandesareas") {
                                        $insere  = "INSERT INTO `".$tabela."` (`codigo`,`nome`)
                                        VALUES ('$codigo', '$nome');";
                                    } else if ($tabela == "tb_subareas") {
                                        $insere  = "INSERT INTO `".$tabela."` (`id_grandearea`,`codigo`,`nome`)
                                        VALUES ('$id', '$codigo', '$nome');";
                                    } else if ($tabela == "tb_especialidades") {
                                        $insere  = "INSERT INTO `".$tabela."` (`id_subarea`,`codigo`,`nome`)
                                        VALUES ('$id', '$codigo', '$nome');";
                                    } else if ($tabela == "tb_subespecialidades"){
                                        $insere  = "INSERT INTO `".$tabela."` (`id_especialidade`,`codigo`,`nome`)
                                        VALUES ('$id', '$codigo', '$nome');";
                                    }
                                    
                                    if ($conexao->query($insere)){
                                        echo "<div class=\"row\">
                                        <div class=\"col-12\">
                                            <div class=\"card card-body\">
                                                <center><h4 class=\"card-title\">Cadastro realizado com sucesso!</h4></center>
                                                <a href=\"ManutencaoLinhasGeral.php\" id=\"cad_novo\" class=\"btn btn-secondary\">Visualizar Linhas!</a>
                                            </div>
                                        </div>";
                                    }
                                    else{
                                        echo "<div class=\"row\">
                                        <div class=\"col-12\">
                                            <div class=\"card card-body\">
                                                <center><h4 class=\"card-title\">Erro ao cadastrar a Linha!</h4></center>
                                                <a href=\"ManutencaoLinhasGeral.php\" id=\"cad_novo\" class=\"btn btn-secondary\">Visualizar Linhas!</a>
                                            </div>
                                        </div>";
                                    }
                               
                                }
                                ?>
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