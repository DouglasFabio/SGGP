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
                           
                            <h4 class="page-title">Listagem de Técnicos em seus grupos:</h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Técnicos</li>
                                        
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
                               
                                <h4 class="card-title">Só é permitido a exclusão de um técnico quando o mesmo foi vinculado no mesmo dia.<br /> <h5 style="font-weight: bold;"></h5></h4>
                                
                            </div>
                            
                            <div class="table-responsive">
                             
                                <table class="table table-hover">
                               
                                    <thead>
                                       
                                        <tr>
                                           
                                            <th scope="col">Grupo</th>
                                            <th scope="col">Nome do Participante</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            
                                            
                                        </tr>
                                        
                                    </thead>
                                       
                                        <tbody>
                                            
                                               <?php
                                                if(isset($_GET['acao']) == "ok"){
                                                    header("Refresh: 0");
                                                } 
                                                
                                                $sigla = $_GET['sigla'];
   
                                                $busca = "SELECT p.nome, p.grupo, p.tipo, p.data_inclusao FROM tb_participantes p WHERE p.grupo ='".$sigla."'";
                                            
                                              

                                                    if ($resultado = $conexao->prepare($busca)) {

                                                        $resultado->execute();

                                                        $resultado->bind_result( $nome, $grupo, $tipo, $data);
                                                        $hoje = date("Y-m-d");
                                                        
                                                        while ($resultado->fetch()) {
                                                            if($tipo == "0" && $data == $hoje){
                                                                printf('<tr><td>'.$sigla.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td><span class="label label-rounded label-success" style="background-color:#4d4dff;">TÉCNICO</span></td>
                                                                       
                                                                       <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$nome.'_editar" style="padding:1px;" name="sigla" value="'.$nome.'">EDITAR</button></td>
                                                                    <form action="EditaGrupos.php" method="post">
                                                                    <div class="modal fade" id="'.$nome.'_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja EDITAR as informações do técnico: '.$nome.'?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$nome.'">Editar</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form>
                                                                        
                                                                    <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$nome.'_excluir" style="padding:1px;" name="sigla" value="'.$nome.'">EXCLUIR</button></td>
                                                                    <form action="../Funcionais/ScriptExcluiTecnicos.php" method="post">
                                                                    <div class="modal fade" id="'.$nome.'_excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja EXCLUIR o técnico: '.$nome.' do sistema?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$nome.'">Excluir</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form></tr>');
                                                            }
                                                            else if($tipo == "1" && $data == $hoje){
                                                                printf('<tr><td>'.$sigla.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td><span class="label label-rounded label-success" style="background-color:#33d6ff;">DOCENTE</span></td>
                                                                        
                                                                         <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$nome.'_editar" style="padding:1px;" name="sigla" value="'.$nome.'">EDITAR</button></td>
                                                                    <form action="EditaGrupos.php" method="post">
                                                                    <div class="modal fade" id="'.$nome.'_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja EDITAR as informações do docente: '.$nome.'?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$nome.'">Editar</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form>
                                                                        
                                                                    <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$nome.'_exclui" style="padding:1px;" name="sigla" value="'.$nome.'">EXCLUIR</button></td>
                                                                    <form action="ExcluiDocentes.php" method="post">
                                                                    <div class="modal fade" id="'.$nome.'_exclui" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja EXCLUIR o docente: '.$nome.' do sistema?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$nome.'">Excluir</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form></tr>');
                                                            }
                                                            else if($tipo == "0" && $data != $hoje){
                                                                printf('<tr><td>'.$sigla.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td><span class="label label-rounded label-success" style="background-color:#4d4dff;">TÉCNICO</span></td>
                                                                       
                                                                       <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$nome.'_editar" style="padding:1px;" name="sigla" value="'.$nome.'">EDITAR</button></td>
                                                                    <form action="EditaGrupos.php" method="post">
                                                                    <div class="modal fade" id="'.$nome.'_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja EDITAR as informações do técnico: '.$nome.'?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$nome.'">Editar</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form>
                                                                        
                                                                    <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$nome.'_desvincula" style="padding:1px;" name="sigla" value="'.$nome.'">DESVINCULAR</button></td>
                                                                    <form action="DesvinculaTecnicos.php" method="post">
                                                                    <div class="modal fade" id="'.$nome.'_desvincula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja DESVINCULAR o técnico: '.$nome.' do grupo?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$nome.'">Desvincular</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form></tr>');
                                                            }
                                                            else if($tipo == "1" && $data != $hoje){
                                                                printf('<tr><td>'.$sigla.'</td>
                                                                        <td>'.$nome.'</td>
                                                                        <td><span class="label label-rounded label-success" style="background-color:#33d6ff;">DOCENTE</span></td>
                                                                        
                                                                         <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$nome.'_editar" style="padding:1px;" name="sigla" value="'.$nome.'">EDITAR</button></td>
                                                                    <form action="EditaGrupos.php" method="post">
                                                                    <div class="modal fade" id="'.$nome.'_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja EDITAR as informações do docente: '.$nome.'?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$nome.'">Editar</button>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div></form>
                                                                        
                                                                    <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#'.$nome.'_desvincula" style="padding:1px;" name="sigla" value="'.$nome.'">DESVINCULAR</button></td>
                                                                    <form action="ExcluiDocentes.php" method="post">
                                                                    <div class="modal fade" id="'.$nome.'_desvincula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Deseja DESVINCULAR o docente: '.$nome.' do grupo?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                <button class="btn btn-primary" name="sigla" value="'.$nome.'">Desvincular</button>
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