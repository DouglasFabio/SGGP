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
                           
                            <h4 class="page-title">Listagem de Membros do Grupo: <?php echo $_GET['sigla']; ?></h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Membros</li>
                                        
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
                               
                                <h5 class="card-title">Só é permitido a exclusão de um membro quando o mesmo foi vinculado no mesmo dia.<br /> <h5 style="font-weight: bold;"></h5></h5>
                                
                            </div>
                            
                            <div class="table-responsive">
                             
                                <table class="table table-hover">
                               
                                    <thead>
                                       
                                        <tr>
                                           
                                            <th scope="col">Grupo</th>
                                            <th scope="col">Nome do Participante</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col"></th>
                                            
                                            
                                        </tr>
                                        
                                    </thead>
                                       
                                        <tbody>
                                               <?php
                                                if(isset($_GET['acao']) == "ok"){
                                                    header("Refresh: 0");
                                                } 
                                                
                                                $sigla = $_GET['sigla'];
   
                                                $busca = "SELECT p.id, p.nome, p.grupo, p.tipo, p.data_sistema, p.data_inclusao, p.data_exclusao FROM tb_participantes p WHERE p.grupo ='".$sigla."' ORDER BY tipo asc";
                                            
                                              

                                                    if ($resultado = $conexao->prepare($busca)) {

                                                        $resultado->execute();

                                                        $resultado->bind_result($id, $nome, $grupo, $tipo, $data, $data_inclusao, $data_exclusao);
                                                        date_default_timezone_set('America/Sao_Paulo');
                                                        $hoje = date("Y-m-d");
                                                        
                                                        while ($resultado->fetch()) {
                                                            if($data_exclusao != "" && $tipo == 0){
                                                                 printf('<tr><td>'.$sigla.'</td>
                                                                            <td>'.$nome.'</td>
                                                                            <td><span class="label label-rounded label-success" style="background-color:#4d4dff;">TÉCNICO</span></td>

                                                                        <td><span class="label label-rounded label-danger">DESVINCULADO</span></td>
                                                                       </tr>');    
                                                            }
                                                             else if($data_exclusao != "" && $tipo == 1){
                                                                 printf('<tr><td>'.$sigla.'</td>
                                                                            <td>'.$nome.'</td>
                                                                            <td><span class="label label-rounded label-success" style="background-color:#33d6ff;">DOCENTE</span></td>

                                                                        <td><span class="label label-rounded label-danger">DESVINCULADO</span></td>
                                                                       </tr>');    
                                                            }
                                                            // ------------------------------------------- EXCLUIR ----------------------------
                                                                else if($tipo == "0" && $data == $hoje){
                                                                    printf('<tr><td>'.$sigla.'</td>
                                                                            <td>'.$nome.'</td>
                                                                            <td><span class="label label-rounded label-success" style="background-color:#4d4dff;">TÉCNICO</span></td>

                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#ET'.$id.'" style="padding:1px;" name="sigla" value="'.$nome.'">EXCLUIR</button></td>
                                                                        <form action="../Funcionais/ExcluiMembro.php" method="post">
                                                                        <div class="modal fade" id="ET'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                              <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Deseja EXCLUIR o técnico: '.$nome.' do sistema?</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                  <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                  <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                    <button class="btn btn-primary" name="excluir" value="'.$nome.'">Excluir</button>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div></form></tr>');
                                                                }
                                                                else if($tipo == "1" && $data == $hoje){
                                                                    printf('<tr><td>'.$sigla.'</td>
                                                                            <td>'.$nome.'</td>
                                                                            <td><span class="label label-rounded label-success" style="background-color:#33d6ff;">DOCENTE</span></td>

                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#ED'.$id.'" style="padding:1px;" name="sigla" value="'.$nome.'">EXCLUIR</button></td>
                                                                        <form action="../Funcionais/ExcluiMembro.php" method="post">
                                                                        <div class="modal fade" id="ED'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                              <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Deseja EXCLUIR o docente: '.$nome.' do sistema?</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                  <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                  <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                    <button class="btn btn-primary" name="excluir" value="'.$nome.'">Excluir</button>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div></form></tr>');
                                                                }
                                                            // ------------------------------------------------------ DESVINCULAR ---------------
                                                                else if($tipo == "0" && $data != $hoje){
                                                                    printf('<tr><td>'.$sigla.'</td>
                                                                            <td>'.$nome.'</td>
                                                                            <td><span class="label label-rounded label-success" style="background-color:#4d4dff;">TÉCNICO</span></td>

                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#DT'.$id.'" style="padding:1px;" name="sigla" value="'.$nome.'">DESVINCULAR</button></td>
                                                                        <form action="../Funcionais/DesvinculaMembro.php" method="post">
                                                                        <div class="modal fade" id="DT'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                              <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Deseja DESVINCULAR o técnico: '.$nome.' do grupo?</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <input type="date" class="form-control" name="data_exclusao" required>
                                                                                  <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                  <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                  <input type="date" class="form-control" name="data_inclusao" value = "'.$data_inclusao.'" hidden>
                                                                                  <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                    <button class="btn btn-primary" name="desvincular" value="'.$nome.'">Desvincular</button>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div></form></tr>');
                                                                }
                                                                else if($tipo == "1" && $data != $hoje){
                                                                    printf('<tr><td>'.$sigla.'</td>
                                                                            <td>'.$nome.'</td>
                                                                            <td><span class="label label-rounded label-success" style="background-color:#33d6ff;">DOCENTE</span></td>

                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#DD'.$id.'" style="padding:1px;" name="sigla" value="'.$nome.'">DESVINCULAR</button></td>
                                                                        <form action="../Funcionais/DesvinculaMembro.php" method="post">
                                                                        <div class="modal fade" id="DD'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                              <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Deseja DESVINCULAR o docente: '.$nome.' do grupo?</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <input type="date" class="form-control" name="data_exclusao" required>
                                                                                  <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                  <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                  <input type="date" class="form-control" name="data_inclusao" value = "'.$data_inclusao.'" hidden>
                                                                                  <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                    <button class="btn btn-primary" name="desvincular" value="'.$nome.'">Desvincular</button>
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