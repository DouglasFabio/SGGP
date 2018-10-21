<!DOCTYPE html>
<html dir="pag" lang="en">

    <script>
    
        
function clicalinha(){
    document.getElementById("linha_mostra").focus();
    var linha = document.getElementById("linha_mostra").value;
    document.getElementById("btnEdita").disabled = false;
    document.getElementById("btnExclui").disabled = false;
    document.getElementById("linha_mostra").value = linha;
    document.getElementById("linhanome").innerHTML = linha;
    document.getElementById("linhanome2").innerHTML = linha;
    document.getElementById("linha_edita").value = linha;
    document.getElementById("linha_exclui").value = linha;
}    

    </script>
    <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['AdmLogin']) && !isset($_SESSION['LiderLogin'])) {

          session_destroy();
            
          header("Location: PaginaInicial.php"); exit;

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
                    
                        include("../Uteis/ScriptValidaCadUsuarios.php");
                    
                    
                    
                    ?>
                    
                    <div class="row">
                   
                    <div class="col-12">
                       
                        <div class="card">
                           
                            <div class="card-body">
                               
                                <h4 class="card-title">Gerencie as Linhas de Pesquisas disponíveis no sistema.<br /></h4>
                                
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table ">
                               
                                    <thead>
                                       
                                        <tr>
                                           
                                            <th scope="col">Linhas de Pesquisa</th>
                                            <th scope="col"></th>  
                                        </tr>
                                        
                                    </thead>
                                       
                                        <tbody>
                                            <tr> 
                                                <td>
                                                        <label><p>Esse MENU se encontra em 4 níveis:<br><br>
                                                                    Grandes Áreas -> Sub-Areas -> Especialidades -> Sub-especialidade (linha de pesquisa).
                                                               </p>
                                                        </label>
                                                   
                                                    <div class="row"> 
                                                    <div class="col-lg-6"> 
                                                     <label>Linha de Pesquisa:</label>
                                                    </div>
                                                        <div class="col-lg-6"> 
                                                    Gerenciar:
                                                    <label><button type="submit" class="btn btn-outline-primary" data-toggle="modal" data-target="#Adiciona">Adicionar</button></label>
                                                    
                                                    <label><button type="submit" class="btn btn-outline-primary" data-toggle="modal" data-target="#Editar" id="btnEdita" disabled="disabled">Editar</button></label>
                                                            
                                                    <label><button type="submit" class="btn btn-outline-primary" data-toggle="modal" data-target="#Excluir" id="btnExclui" disabled="disabled">Excluir</button></label>
                                                             
                                                        <br/>
                                                    </div>
                                                    </div>
                                                    
                                                <div class="row"> 
                                                    
                                                    <div class="col-lg-6"> 
                                                        
                                                        <input type="text" onFocusout="clicalinha()" class="form-control" style="height: 47px;" id="linha_mostra" name="linha_mostra">
                                                        
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
                                                                            printf('<li> <a href="#" onClick="clicalinha();" data-toggle="collapse" data-target="#id'.$codigo2.'" class="list-group-item list-group-item-action" style="background-color:#a6a6a6; margin-left:-40px; width:initial;"> <span class="">'.$nome2.' </span> <span class="fa fa-chevron-left pull-right"></span> </a> <ul class="collapse" id="id'.$codigo2.'" style="list-style-type:none">');

                                                                            $linhas = busca($cont);
                                                                            
                                                                            
                                                                            // mostra sub areas
                                                                           
                                                                            foreach($linhas as $row){
                                                                                printf ('<li><a href="#" onClick="clicalinha();" data-toggle="collapse" data-target="#id'.$row['codigo'].'" class="list-group-item list-group-item-action" style="background-color:#bfbfbf; margin-left:-80px; width:initial;" > <span class=""> '.$row['nome'].' </span> <span class="fa fa-chevron-left pull-right"></span> </a><ul class="collapse" id="id'.$row['codigo'].'" style="list-style-type:none">');
                                                                                
                                                                                $linhas2 = busca2($cont2);
                                                                                
                                                                                // mostra especialidades
                                                                            
                                                                                foreach($linhas2 as $row2){
                                                                                    printf ('<li><a href="#" data-toggle="collapse" onClick="clicalinha();" data-target="#id'.$row2['codigo'].'" class="list-group-item list-group-item-action" style="background-color:#d9d9d9; margin-left:-120px; width:initial;"> <span class=""> '.$row2['nome'].'</span></a><ul class="collapse" id="id'.$row2['codigo'].'" style="list-style-type:none">');
                                                                                    
                                                                                    $linhas3 = busca3($cont3);
                                                                                   
                                                                                    
                                                                                    //mostra sub-especialidades
                                                                                   
                                                                                    foreach($linhas3 as $row3){
                                                                                        printf ('<li><a onClick="clicalinha();" class="list-group-item" style="background-color:#f2f2f2; margin-left:-160px; width:initial;">'.$row3['nome'].'</a></li>');   
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
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <form action="../Funcionais/NovaLinha.php" method="post">
                    <div class="modal fade" id="Adiciona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Adicionar uma nova linha!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" name="sigla" value="'.$sigla.'">Adicionar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </form>
                <form action="../Funcionais/MudaLinha.php" method="post">
                    <div class="modal fade" id="Editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar a linha: </h5>
                              <h5 class="modal-title" id="linhanome2"> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <input type="text" class="form-control" style="height: 47px;" id="linha_mostra" name="linha_edita" hidden>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" name="sigla" value="'.$sigla.'">Editar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </form>
                <form action="../Funcionais/ApagaLinha.php" method="post">
                    <div class="modal fade" id="Excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Excluir a linha: </h5>
                              <h5 class="modal-title" id="linhanome"> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <input type="text" class="form-control" style="height: 47px;" id="linha_mostra" name="linha_exclui" hidden>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" name="sigla" value="'.$sigla.'">Excluir</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </form>
    
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