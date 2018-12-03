<!DOCTYPE html>
<html dir="pag" lang="en">
 
    <?php

        if (!isset($_SESSION)) session_start();

        if ( !isset($_SESSION['LiderLogin'])) {

          
            
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
                           
                            <h4 class="page-title">Reuniões do Grupo: <?php echo $_POST['sigla']; ?></h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Reuniões</li>
                                        
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
                            
                            <div class="table-responsive">
                             
                                <table class="table table-hover">
                               
                                    <thead>
                                       
                                        <tr>
                                           
                                            <th scope="col">Data</th>
                                            <th scope="col">Hora</th>
                                            <th scope="col">Pauta</th>
                                            <th scope="col">Situação</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            
                                            
                                        </tr>
                                        
                                    </thead>
                                       
                                        <tbody>
                                               <?php
                                            
                                                $sigla = $_POST['sigla'];
                                            
                                                $busca = "SELECT g.sigla, r.id, r.data, r.inicio_previsao, r.pauta, r.situacao, r.inicio_real FROM tb_reunioes as r, tb_grupospesquisa as g WHERE g.sigla = r.grupo AND g.sigla ='".$sigla."' ORDER BY r.situacao";
                                            
                                                date_default_timezone_set('America/Sao_Paulo');
                                                $hoje = date("Y-m-d");
                                                $agora = date("H:i:s");
                        
                                            
                                                    if ($resultado = $conexao->prepare($busca)) {

                                                        $resultado->execute();

                                                        $resultado->bind_result($grupo, $id, $data, $hora, $pauta, $situacao, $hora_real);
                                                        while ($resultado->fetch()) {
                                                            if($situacao == "2"){
                                                                printf('<tr><td>'.$data.'</td>
                                                                            <td>'.$hora_real.'</td>
                                                                            <td>'.$pauta.'</td>
                                                                            <td><span class="label label-rounded label-danger">FINALIZADA</span></td>
                                                                            <td></td>
                                                                            <td></td>');
                                                            }  
                                                            else if($hoje >= $data && $agora >= $hora){
                                                                printf('<tr><td>'.$data.'</td>
                                                                            <td>'.$hora.'</td>
                                                                            <td>'.$pauta.'</td>
                                                                            <td><span class="label label-rounded label-warning">EM ANDAMENTO</span></td>
                                                                            <td></td>');
                                                                printf('<td>
                                                                        <form action="FinalizaReuniao.php" method="post">
                                                                        <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                        <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                        <button class="btn btn-outline-primary" style="padding:1px;">FINALIZAR</button></form>
                                                                        <br/>
                                                                        <form action="EditaReuniao.php" method="post">
                                                                        <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                        <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                        <button class="btn btn-outline-primary" style="padding:1px;">EDITAR</button></form>
                                                                    <br>
                                                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#EX'.$id.'" style="padding:1px;">EXCLUIR</button>
                                                                    </td>
                                                                                <form action="../Funcionais/ExcluiReuniao.php" method="post">
                                                                            <div class="modal fade" id="EX'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                  <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                      <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Deseja realmente excluir permanentemente a reunião com pauta: '.$pauta.'?</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                          <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                      </div>
                                                                                      <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                      <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                      <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                        <button class="btn btn-primary" name="desvincular" value="'.$id.'">Excluir</button>
                                                                                      </div>
                                                                                    </div>
                                                                                  </div>
                                                                                </div></form></tr>');
                                                                
                                                            }
                                                            else{
                                                                printf('<tr><td>'.$data.'</td>
                                                                            <td>'.$hora.'</td>
                                                                            <td>'.$pauta.'</td>
                                                                            <td><span class="label label-rounded label-success">AGENDADA</span></td>
                                                                            <td></td>');
                                                                printf('<td>
                                                                        <form action="EditaReuniao.php" method="post">
                                                                        <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                        <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                        <button class="btn btn-outline-primary" style="padding:1px;">EDITAR</button></form>
                                                                    <br>
                                                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#EX'.$id.'" style="padding:1px;">EXCLUIR</button>
                                                                    </td>
                                                                                <form action="../Funcionais/ExcluiReuniao.php" method="post">
                                                                            <div class="modal fade" id="EX'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                  <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                      <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Deseja realmente excluir permanentemente a reunião com pauta: '.$pauta.'?</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                          <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                      </div>
                                                                                      <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                      <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                      <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                        <button class="btn btn-primary" name="desvincular" value="'.$id.'">Excluir</button>
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
                                    <hr/>
                                    <div class="card card-body" >
                                        <form action="CadReuniao.php" method="post" style="position: right;">
                                            <button class="btn btn-outline-primary" style="padding:1px;" name="sigla" value="<?php echo $sigla; ?>">NOVA REUNIÃO</button>
                                        </form>
                                    </div>
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