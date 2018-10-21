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
                           
                            <h4 class="page-title">Manutenção dos Grupos de Pesquisa</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Grupos</li>
                                        
                                    </ol>
                                    
                                </nav>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="container-fluid">
                    <?php
                    
                        include("../Uteis/ScriptValidaInfoGrupos.php");

                    ?>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-body">
                                <h4 class="card-title">Grupo de Pesquisa</h4>
                                
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <form name="formEdCadGrupos" method="post" action="../Visuais/AtualizandoGrupos.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <div class="form-group">
                                        <label >Nome:</label>                                  
                                        <?php
                                        $sigla = $_POST['sigla'];     
                                        $busca = "SELECT nome, sigla, email, link, descricao, logotipo, data_inicio, situacao  FROM tb_grupospesquisa WHERE sigla='".$sigla."'";

                                        if ($resultado = $conexao->prepare($busca)) {
                                            $resultado->execute();
                                            $resultado->bind_result($nome, $sigla, $email, $link, $descricao, $logo, $data_inicio, $situacao);
                                            
                                            
                                                
                                            
                                                
                                            if($resultado->fetch()) {
                                                printf('<input type="text" class="form-control" id="nome_grupo" name="nome_grupo" maxlength="50" value="'.$nome.'">');
                                                ?>  
                                    </div>
                                                <div class="form-group">
                                                    <label >Sigla:</label>                                  
                                                    <?php
                                                        printf('<input type="text" class="form-control" id="sigla_grupo" name="sigla_grupo" maxlength="10" value="'.$sigla.'">');
                                                    ?>  
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label >Sigla Antiga:</label>                                  
                                                    <?php
                                                        printf('<input type="text" class="form-control" id="sigla_antiga" name="sigla_antiga" value="'.$sigla.'">');
                                                    ?>  
                                                </div>
                                                <div class="form-group"> 
                                                    <label>Email do Grupo:</label>
                                                    <?php
                                                        printf('<input type="email" class="form-control" id="email_grupo" name="email_grupo" maxlength="50" value="'.$email.'">');
                                                    ?>
                                                </div>
                                                <div class="form-group"> 
                                                    <label>Link CNPq:</label>
                                                    <?php
                                                        printf('<input type="text" class="form-control" id="link_grupo" maxlength="100" name="link_grupo" value="'.$link.'">');
                                                    ?>
                                                </div>
                                                <div class="form-group"> 
                                                    <label>Descrição:</label>
                                                    <?php
                                                        printf(' <textarea style="resize: none;" class="form-control" rows="5" id="desc_grupo" name="desc_grupo">'.$descricao.'</textarea>');
                                                    ?>
                                                </div>
                                                <div class="form-group"> 
                                                    <label>Logotipo:</label>
                                                    <?php
                                                        printf('<input type="file" class="form-control" id="arquivo" name="arquivo">');
                                                    ?>
                                                </div>
                                                <div class="form-group"> 
                                                    <label>Data de Início:</label>
                                                    <?php
                                                        printf('<input type="month" class="form-control" id="datainicio_grupo" name="datainicio_grupo" value="'.$data_inicio.'">');
                                                    ?>
                                                </div>
                                                <?php
                                        }

                                    }
                                    else {
                                        printf( "Erro no SQL!");
                                    }
                                    if($situacao == 2){
                                        
                                        
                                    $resultado->close();                  
                                ?>
                                               <label>Linha de Pesquisa:</label>
                                                <div class="row"> 
                                                    
                                                    <div class="col-lg-6"> 
                                                        
                                                        <input type="text" class="form-control" style="    height: 47px;" id="linha_mostra" name="linha_mostra">
                                                        
                                                        <?php
                                                            include("../Uteis/ScriptAutoComplete.php");
                                                        ?>
                                                        
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        <a href="EditaGrupos.php" data-toggle="collapse" data-target="#grandes_areas" class="list-group-item list-group-item-action" style="background-color:#ffffff"><span class="nav-label"> Linhas disponíveis</span></a>
                                                            
                                                    </div>
                                                    <div class="col-lg-12">
                                                    <ul class="sub-menu-1 collapse" id="grandes_areas" style="list-style-type:none">
                                                                <?php
                                                                    include("../Uteis/ScriptCapes.php");   
                                                                
                                                                    $busca2 = "SELECT * FROM tb_grandesareas";

                                                                    if ($resultado2 = $conexao->prepare($busca2)) {

                                                                    $resultado2->execute();

                                                                    $resultado2->bind_result($id, $codigo2, $nome2);
                                                                        $cont = 1;
                                                                        $cont2 = 1;
                                                                        $cont3 = 1;
                                                                        //mostra grande areas
                                                                     
                                                                        while ($resultado2->fetch()) {
                                                                            printf('<li> <a href="#" data-toggle="collapse" data-target="#id'.$codigo2.'" class="list-group-item list-group-item-action" style="background-color:#a6a6a6; margin-left:-40px; width:initial;"> <span class="">'.$nome2.' </span> <span class="fa fa-chevron-left pull-right"></span> </a> <ul class="collapse" id="id'.$codigo2.'" style="list-style-type:none">');

                                                                            $linhas = busca($cont);
                                                                            
                                                                            
                                                                            // mostra sub areas
                                                                           
                                                                            foreach($linhas as $row){
                                                                                printf ('<li><a href="#" data-toggle="collapse" data-target="#id'.$row['codigo'].'" class="list-group-item list-group-item-action" style="background-color:#bfbfbf; margin-left:-80px; width:initial;" > <span class=""> '.$row['nome'].' </span> <span class="fa fa-chevron-left pull-right"></span> </a><ul class="collapse" id="id'.$row['codigo'].'" style="list-style-type:none">');
                                                                                
                                                                                $linhas2 = busca2($cont2);
                                                                                
                                                                                // mostra especialidades
                                                                            
                                                                                foreach($linhas2 as $row2){
                                                                                    printf ('<li><a href="#" data-toggle="collapse" data-target="#id'.$row2['codigo'].'" class="list-group-item list-group-item-action" style="background-color:#d9d9d9; margin-left:-120px; width:initial;"> <span class=""> '.$row2['nome'].'</span></a><ul class="collapse" id="id'.$row2['codigo'].'" style="list-style-type:none">');
                                                                                    
                                                                                    $linhas3 = busca3($cont3);
                                                                                   
                                                                                    
                                                                                    //mostra sub-especialidades
                                                                                   
                                                                                    foreach($linhas3 as $row3){
                                                                                        printf ('<li><a onClick="clicalinha(\''.$row3['nome'].'\');" class="list-group-item" style="background-color:#f2f2f2; margin-left:-160px; width:initial;">'.$row3['nome'].'</a></li>');   
                                                                                    }
                                                                                    printf("</ul></li>");
                                                                                    $cont3++;                   
                                                                                }
                                                                                printf("</ul></li>");
                                                                                $cont2++;
                                                                            }

                                                                            printf('</ul></li>');
                                                                            $cont++;
                                                                        }
                                                                    }

                                                                ?>
                                                            </ul>
                                                        </div>
                                            </div>
                                            <div class="form-group"> 
                                                <label>Data de Vínculo da Linha de Pesquisa:</label>
                                                    <input type="date" class="form-control" id="datavinculo_grupo" name="datavinculo_grupo">
                                            </div>
                                            <div class="form-group"> 
                                                <label>Descrição da Linha de Pesquisa:</label>
                                                <textarea style="resize: none;" class="form-control" rows="3" id="desclinha_grupo" name="desclinha_grupo"></textarea>
                                            </div>
                                <?php
                                    }
                                    $resultado->close();            
                                ?>
                                                <br/>
                                                <input type="submit" onclick="return validar()" value="Gravar" id="gravar_grupo" class="btn btn-secondary"/>
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