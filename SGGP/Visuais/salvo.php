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

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-body">
                                <h4 class="card-title">Linhas do Grupo</h4>
                                <div class="table-responsive">
                              
                                <table class="table table-hover">
                               
                                    <thead>
                                       
                                        <tr>
                                            <th scope="col">Codigo</th>
                                            <th scope="col">Nome da Linha</th>
                                            <th scope="col">Situação</th>
                                            <th scope="col">Gerenciar</th>
                                            
                                        </tr>
                                        
                                    </thead>
                                       
                                        <tbody>
                                               <?php
                                            
                                                    $sigla = $_POST['sigla'];
                                                    date_default_timezone_set('America/Sao_Paulo');
                                                    $hoje = date('Y-m-d');
                                                    $busca = "SELECT lg.id, lg.codigo_capes, lg.data_cad, lg.fim_vinculo , s.nome FROM tb_linhasgrupos as lg, tb_subespecialidades as s WHERE lg.grupo = '".$sigla."' AND s.codigo = lg.codigo_capes";
                                                    
                                            
                                                         
                                                    
                                                    if ($resultado = $conexao->prepare($busca)) {
                                                        $result = $conexao->query($busca);
                                                        $resultado->execute();

                                                        $resultado->bind_result($id, $codigo, $data, $fim, $nome);
                                                        echo $sigla;
                                                        while ($resultado->fetch()) {
                                                            if($result->num_rows == 1){
                                                                 printf('<tr>
                                                                        <td>'.$codigo.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td><span class="label label-rounded label-success">VINCULADA</span></td>
                                                                        <td> - </td>
                                                                    </form></tr>');
                                                            }
                                                            else if($data == $hoje){
                                                                printf('<tr>
                                                                        <td>'.$codigo.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td><span class="label label-rounded label-success">VINCULADA</span></td>
                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#M'.$id.'" style="padding:1px;" name="id" value="'.$id.'">EXCLUIR</button> </td>
                                                                    <form action="../Funcionais/ExcluiLinha.php" method="post">
                                                                    <div class="modal fade" id="M'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Você realmente deseja excluir a linha: '.$nome.'?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <input name="id" value="'.$id.'" hidden>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$sigla.'">Excluir</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form></tr>');
                                                            }else if($fim != ""){
                                                                printf('<tr>
                                                                        <td>'.$codigo.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td><span class="label label-rounded label-danger">DESVINCULADA</span></td>
                                                                        <td> - </td>
                                                                    </form></tr>');
                                                            }else{
                                                                printf('<tr>
                                                                        <td>'.$codigo.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td><span class="label label-rounded label-success">VINCULADA</span></td>
                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#M'.$id.'" style="padding:1px;" name="id" value="'.$id.'">DESVINCULAR</button> </td>
                                                                    <form action="../Funcionais/DesvinculaLinha.php" method="post">
                                                                    <div class="modal fade" id="M'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Qual a data de desvinculo da linha: '.$nome.'?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <input name="id" value="'.$id.'" hidden>
                                                                              <input type="date" class="form-control" id="datadesvinculo_grupo" name="datadesvinculo_grupo">
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$sigla.'">Desvincular</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form></tr>');
                                                            }
                                                            
                                                        }

                                                    }
                                                    else {

                                                        printf( "Erro no SQL!");

                                                    }

                                                    $resultado->close();
                                                    
                                                ?>
                                        </tbody>        
                                    </table>
                                    
                                </div>
                                
                                <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                                <form name="formAdLinha" method="post" action="../Funcionais/AdLinha.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <div class="form-group">
                                               <label>Linha de Pesquisa:</label>
                                                <div class="row"> 
                                                    
                                                    <div class="col-lg-6"> 
                                                       
                                                        <input name="sigla" value="<?php echo $sigla; ?>" hidden>
                                                        
                                                        <input type="text" class="form-control" style="height: 47px;" id="linha_mostra" name="linha_mostra">
                                                        
                                                        <?php
                                                            include("../Uteis/ScriptAutoComplete.php");
                                                        ?>
                                                        
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        <a data-toggle="collapse" data-target="#grandes_areas" class="list-group-item list-group-item-action" style="background-color:#ffffff"><span class="nav-label"> Linhas disponíveis</span></a>
                                                            
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

                                                <br/>
                                                <input type="submit" value="Gravar" id="gravar_grupo" class="btn btn-secondary"/>
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
            include("../Uteis/ScriptsPainel.php");
        ?>
    </body>
</html>