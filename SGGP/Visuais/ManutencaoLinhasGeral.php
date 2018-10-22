<!DOCTYPE html>
<html dir="pag" lang="en">

    <script>
function testa(){
    document.getElementById("h5modal").innerHTML = "Adicionar grande area!";
}
        
function clicalinha(){
    document.getElementById("linha_mostra").focus();
    var linha = document.getElementById("linha_mostra").value;
    document.getElementById("btnEdita").disabled = false;
    document.getElementById("btnExclui").disabled = false;
    document.getElementById("linha_mostra").value = linha;
    document.getElementById("linha_edita").value = linha;
    document.getElementById("linha_exclui").value = linha;
    document.getElementById("linha_add").value = linha;
}   
function clicalinha2(linha){
    document.getElementById("btnAdd").disabled = false;
    document.getElementById("btnEdita").disabled = false;
    document.getElementById("btnExclui").disabled = false;
    document.getElementById("linha_mostra").value = linha;
    document.getElementById("linha_edita").value = linha;
    document.getElementById("linha_exclui").value = linha;
    document.getElementById("linha_add").value = linha;
}  
function clicalinha3(linha){
    document.getElementById("btnAdd").disabled = true;
    document.getElementById("btnEdita").disabled = false;
    document.getElementById("btnExclui").disabled = false;
    document.getElementById("linha_mostra").value = linha;
    document.getElementById("linha_edita").value = linha;
    document.getElementById("linha_exclui").value = linha;
    document.getElementById("linha_add").value = linha;
} 

    </script>
    <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['AdmLogin'])) {
            
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
                                                               <br/>
                                                               <p>
                                                                   Selecione a linha que deseja realizar a manutenção e clique em um dos botões ao lado.
                                                               </p>
                                                        </label>
                                                   
                                                    <div class="row"> 
                                                    <div class="col-lg-6"> 
                                                     <label>Linha de Pesquisa:</label>
                                                    </div>
                                                        <div class="col-lg-6"> 
                                                    Gerenciar:
                                                    <label><button type="submit" onClick="testa();" class="btn btn-outline-primary" data-toggle="modal" id="btnAdd" data-target="#Adiciona">Adicionar</button></label>
                                                    
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
                                                                            printf('<li> <a href="#" onClick="clicalinha2(\''.$nome2.'\');" data-toggle="collapse" data-target="#id'.$codigo2.'" class="list-group-item list-group-item-action" style="background-color:#a6a6a6; margin-left:-40px; width:initial;"> <span class="">'.strtoupper($nome2).' </span> <span class="fa fa-chevron-left pull-right"></span> </a> <ul class="collapse" id="id'.$codigo2.'" style="list-style-type:none">');

                                                                            $linhas = busca($cont);
                                                                            
                                                                            
                                                                            // mostra sub areas
                                                                           
                                                                            foreach($linhas as $row){
                                                                                printf ('<li><a href="#" onClick="clicalinha2(\''.$row['nome'].'\');" data-toggle="collapse" data-target="#id'.$row['codigo'].'" class="list-group-item list-group-item-action" style="background-color:#bfbfbf; margin-left:-80px; width:initial;" > <span class=""> '.strtoupper($row['nome']).' </span> <span class="fa fa-chevron-left pull-right"></span> </a><ul class="collapse" id="id'.$row['codigo'].'" style="list-style-type:none">');
                                                                                
                                                                                $linhas2 = busca2($cont2);
                                                                                
                                                                                // mostra especialidades
                                                                            
                                                                                foreach($linhas2 as $row2){
                                                                                    printf ('<li><a href="#" data-toggle="collapse" onClick="clicalinha2(\''.$row2['nome'].'\');" data-target="#id'.$row2['codigo'].'" class="list-group-item list-group-item-action" style="background-color:#d9d9d9; margin-left:-120px; width:initial;"> <span class=""> '.strtoupper($row2['nome']).'</span></a><ul class="collapse" id="id'.$row2['codigo'].'" style="list-style-type:none">');
                                                                                    
                                                                                    $linhas3 = busca3($cont3);
                                                                                   
                                                                                    
                                                                                    //mostra sub-especialidades
                                                                                   
                                                                                    foreach($linhas3 as $row3){
                                                                                        printf ('<li><a onClick="clicalinha3(\''.$row3['nome'].'\');" class="list-group-item" style="background-color:#f2f2f2; margin-left:-160px; width:initial;">'.strtoupper($row3['nome']).'</a></li>');   
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
                <form action="../Visuais/NovaLinha.php" method="post">
                    <div class="modal fade" id="Adiciona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="h5modal">Adicionar uma nova linha dentro de: </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <input type="text" class="form-control" style="height: 47px;" id="linha_add" name="linha_add" readonly>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <input type="text" class="form-control" style="height: 47px;" id="linha_edita" name="linha_edita" readonly>
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <input type="text" class="form-control" style="height: 47px;" id="linha_exclui" name="linha_exclui" readonly>
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