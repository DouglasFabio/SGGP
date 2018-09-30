<!DOCTYPE html>
<html dir="pag" lang="en">

    <script>
    
    function pegaGrupo(var contador){
        
        contador = document.getElementById("ativar");
        
        window.alert(contador);
    }
    </script>
 
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
                    
                        include("../Uteis/ScriptValidaCadUsuarios.php");
                    
                    
                    
                    ?>
                    
                    <div class="row">
                   
                    <div class="col-12">
                       
                        <div class="card">
                           
                            <div class="card-body">
                               
                                <h4 class="card-title">Gerencie todos os grupos de pesquisa disponíveis.<br /></h4>
                                
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                               
                                    <thead>
                                       
                                        <tr>
                                           
                                            <th scope="col">Sigla</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Líder</th>
                                            <th scope="col">Situação</th>
                                            <th scope="col"></th>   
                                        </tr>
                                        
                                    </thead>
                                       
                                        <tbody>
                                            
                                               <?php
                                            
                                                    $busca = "SELECT distinct gp.nome, gp.sigla, gp.situacao, l.nome 
                                                              FROM tb_grupospesquisa as gp, tb_lideres as l 
                                                              WHERE gp.lider = l.lider ORDER BY situacao desc";

                                                    if ($resultado = $conexao->prepare($busca)) {

                                                        $resultado->execute();

                                                        $resultado->bind_result($nome, $sigla, $situacao, $lider);
                                                        
                                                        while ($resultado->fetch()) {
                                                            //SITUAÇÃO 2: Grupo AGUARDANDO ativação----------------------------------------------
                                                            if($situacao === 2){
                                                                printf('
                                                                        <tr><td>'.$sigla.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td>'.$lider.'</td>
                                                                        <td><span class="label label-rounded label-warning">AGUARDANDO</span></td>
                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$sigla.'" style="padding:1px;" name="sigla" value="'.$sigla.'">EXCLUIR</button></td>
                                                                    </tr>
                                                                    <form action="../Funcionais/ScriptExcluiGrupos.php" method="post">
                                                                    <div class="modal fade" id="'.$sigla.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja realmente excluir o grupo: '.$nome.'?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$sigla.'">Excluir</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form>');
                                                            //SITUAÇÃO 1: Grupo ATIVO ---------------------------------------------------------
                                                            }else if($situacao === 1){
                                                                printf('<tr><td>'.$sigla.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td>'.$lider.'</td>
                                                                        <td><span class="label label-rounded label-success">ATIVO</span></td>
                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$sigla.'" style="padding:1px;" name="sigla" value="'.$sigla.'">INATIVAR</button></td>
                                                                    </tr>
                                                                    <form action="../Funcionais/ScriptInativarGrupos.php" method="post">
                                                                    <div class="modal fade" id="'.$sigla.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja inativar o grupo: '.$nome.'?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$sigla.'">Inativar</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form>');
                                                            //SITUAÇÃO 0: Grupo INATIVO ---------------------------------------------------------
                                                            }else{
                                                                printf('<tr><td>'.$sigla.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td>'.$lider.'</td>
                                                                        <td><span class="label label-rounded label-danger">INATIVO</span></td>
                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$sigla.'" style="padding:1px;" name="sigla" value="'.$sigla.'">REATIVAR</button></td>
                                                                    </tr>
                                                                    <form action="../Funcionais/ScriptReativarGrupos.php" method="post">
                                                                    <div class="modal fade" id="'.$sigla.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja reativar o grupo: '.$nome.'?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$sigla.'">Reativar</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form>');
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