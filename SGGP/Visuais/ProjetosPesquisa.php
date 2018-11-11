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
                           
                            <h4 class="page-title">Projetos de Pesquisa do Grupo: <?php echo $_POST['sigla']; ?></h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Projetos de Pesquisa</li>
                                        
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
                                           
                                            <th scope="col">Título</th>
                                            <th scope="col">Docente Responsável</th>
                                            <th scope="col">Orientação</th>
                                            <th scope="col"></th>
                                            
                                            
                                        </tr>
                                        
                                    </thead>
                                       
                                        <tbody>
                                               <?php
                                            
                                                $sigla = $_POST['sigla'];
                                            
                                                $busca = "SELECT p.id, p.titulo, p.docente, p.data_fim, p.aluno, a.nome, d.nome 
                                                          FROM tb_projetospesquisa as p 
                                                          INNER JOIN tb_participantes as d 
                                                          ON p.docente = d.id 
                                                          INNER JOIN tb_alunos as a 
                                                          ON a.id = p.aluno 
                                                          WHERE p.grupo ='".$sigla."' 
                                                          UNION 
                                                          SELECT p.id, p.titulo, p.docente, p.data_fim, p.aluno, a.nome, d.nome 
                                                          FROM tb_projetospesquisa as p 
                                                          INNER JOIN tb_participantes as d 
                                                          ON p.docente = d.id 
                                                          INNER JOIN tb_alunos as a 
                                                          ON a.id = 1 
                                                          WHERE p.grupo ='".$sigla."' 
                                                          ORDER BY id asc;";
                                            
                                                    if ($resultado = $conexao->prepare($busca)) {

                                                        $resultado->execute();

                                                        $resultado->bind_result($id, $titulo, $docente, $data_fim, $aluno, $nomealuno, $nomedocente);
                                                        while ($resultado->fetch()) {
                                                            if($nomealuno == "----" && $aluno != NULL){}
                                                            else if($data_fim != ""){
                                                                printf('<tr><td>'.$titulo.'</td>
                                                                            <td>'.$nomedocente.'</td>
                                                                            <td>Projeto finalizado em: '.$data_fim.'</td>');
                                                                 printf('<td><form action="EditaProjetosPesquisa.php" method="post">
                                                                        <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                        <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                        <button class="btn btn-outline-primary" style="padding:1px;">EDITAR</button></form>
                                                                    <br>
                                                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#EX'.$id.'" style="padding:1px;">EXCLUIR</button>
                                                                    </td>
                                                                                <form action="../Funcionais/ExcluiProjeto.php" method="post">
                                                                            <div class="modal fade" id="EX'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                  <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                      <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Deseja realmente excluir permanentemente o projeto: '.$titulo.'?</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                          <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                      </div>
                                                                                      <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                      <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                      <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                        <button class="btn btn-primary" name="desvincular" value="'.$titulo.'">Excluir</button>
                                                                                      </div>
                                                                                    </div>
                                                                                  </div>
                                                                                </div></form></tr>');
                                                            }else{
                                                                printf('<tr><td>'.$titulo.'</td>
                                                                                <td>'.$nomedocente.'</td>'
                                                                                );
                                                                     if($aluno == ""){
                                                                        printf('<td><form action="CadDiscente.php" method="post">
                                                                        <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                        <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                        <input type="text" class="form-control" name="titulo" value = "'.$titulo.'" hidden>
                                                                        <button class="btn btn-outline-primary" style="padding:1px;">ADD ORIENTAÇÃO</button><br><br/></form></td>');
                                                                    }
                                                                    else{
                                                                        printf('
                                                                            <td>'.$nomealuno.'<br><br>'
                                                                            );
                                                                    
                                                                    printf('<button class="btn btn-outline-primary" data-toggle="modal" data-target="#FO'.$id.'" style="padding:1px;">FINALIZAR ORIENTAÇÃO</button>
                                                                    <br>
                                                                    <br>
                                                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#FP'.$id.'" style="padding:1px;">FINALIZAR PROJETO</button>
                                                                    </td>
                                                                            <form action="../Funcionais/FinalizarProjeto.php" method="post">
                                                                            <div class="modal fade" id="FP'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                  <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                      <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Deseja finalizar o projeto: '.$titulo.'?</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                          <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                      </div>
                                                                                      <input type="date" class="form-control" name="data_fim" required>
                                                                                      <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                      <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                      <input type="text" class="form-control" name="aluno" value = "'.$aluno.'" hidden>
                                                                                      <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                        <button class="btn btn-primary" name="desvincular" value="'.$titulo.'">Finalizar</button>
                                                                                      </div>
                                                                                    </div>
                                                                                  </div>
                                                                                </div></form>
                                                                            <form action="../Funcionais/FinalizarOrientacao.php" method="post">
                                                                            <div class="modal fade" id="FO'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                  <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                      <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Deseja finalizar o projeto: '.$titulo.'?</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                          <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                      </div>
                                                                                      <input type="date" class="form-control" name="data_fim" required>
                                                                                      <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                      <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                      <input type="text" class="form-control" name="aluno" value = "'.$aluno.'" hidden>
                                                                                      <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                        <button class="btn btn-primary" name="desvincular" value="'.$titulo.'">Finalizar</button>
                                                                                      </div>
                                                                                    </div>
                                                                                  </div>
                                                                                </div></form>');
                                                                        }
                                                                 printf('<td><form action="EditaProjetosPesquisa.php" method="post">
                                                                        <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                        <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                        <button class="btn btn-outline-primary" style="padding:1px;">EDITAR</button></form>
                                                                    <br>
                                                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#EX'.$id.'" style="padding:1px;">EXCLUIR</button>
                                                                    </td>
                                                                                <form action="../Funcionais/ExcluiProjeto.php" method="post">
                                                                            <div class="modal fade" id="EX'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                  <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                      <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Deseja realmente excluir permanentemente o projeto: '.$titulo.'?</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                          <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                      </div>
                                                                                      <input type="text" class="form-control" name="sigla" value = "'.$sigla.'" hidden>
                                                                                      <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                      <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                                        <button class="btn btn-primary" name="desvincular" value="'.$titulo.'">Excluir</button>
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
                                        <form action="CadProjetosPesquisa.php" method="post" style="position: right;">
                                            <button class="btn btn-outline-primary" style="padding:1px;" name="sigla" value="<?php echo $sigla; ?>">NOVO PROJETO</button>
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