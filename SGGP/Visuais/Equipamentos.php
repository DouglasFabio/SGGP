<!DOCTYPE html>
<html dir="pag" lang="en">
 
    <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['LiderLogin'])) {

          
            
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
                           
                            <h4 class="page-title">Listagem de Equipamentos do Grupo: <?php echo $_POST['sigla']; ?></h4>
                            
                        </div>
                        
                        <div class="col-7 align-self-center">
                           
                            <div class="d-flex align-items-center justify-content-end">
                               
                                <nav aria-label="breadcrumb">
                                   
                                    <ol class="breadcrumb">
                                       
                                        <li class="breadcrumb-item">
                                           
                                            <a href="#">SGGP</a>
                                            
                                        </li>
                                        
                                        <li class="breadcrumb-item active" aria-current="page">Gerenciar Equipamentos</li>
                                        
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
                                           
                                            <th scope="col">Nome</th>
                                            <th scope="col">Descrição</th>
                                            <th scope="col">Inicio da disponibilidade</th>
                                            <th scope="col"></th>
                                            
                                            
                                        </tr>
                                        
                                    </thead>
                                       
                                        <tbody>
                                               <?php
                                            
                                                $sigla = $_POST['sigla'];
   
                                                $busca = "SELECT id, nome, grupo, descricao, data_inicio, data_fim FROM tb_equipamentos WHERE grupo ='".$sigla."' ORDER BY id asc";

                                                    if ($resultado = $conexao->prepare($busca)) {

                                                        $resultado->execute();

                                                        $resultado->bind_result($id, $nome, $grupo, $descricao, $data_in, $data_ex);
                                                        
                                                        while ($resultado->fetch()) {
                                                            if($data_ex != ""){
                                                                //Equipamento já finalizado
                                                            }
                                                             else{
                                                                 printf('<tr><td>'.$nome.'</td>
                                                                            <td>'.$descricao.'</td>
                                                                            <td>'.$data_in.'</td>
                                                                        <td><button class="btn btn-outline-primary" data-toggle="modal" data-target="#EQ'.$id.'" style="padding:1px;" name="sigla" value="'.$nome.'">DESVINCULAR</button></td>
                                                                        <form action="../Funcionais/DesvinculaEquipamento.php" method="post">
                                                                        <div class="modal fade" id="EQ'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                              <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Deseja DESVINCULAR O EQUIPAMENTO '.$nome.' DO GRUPO '.$grupo.'?</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <input type="date" class="form-control" name="data_ex" required>
                                                                                  <input type="text" class="form-control" name="sigla" value = "'.$grupo.'" hidden>
                                                                                  <input type="text" class="form-control" name="id" value = "'.$id.'" hidden>
                                                                                  <input type="text" class="form-control" name="data_in" value = "'.$data_in.'" hidden>
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
                                    <hr/>
                                  
                                    <div class="card card-body">
                                         <h4 > Cadastrar novo equipamento: </h4>
                                        <form name="formCadEquipamentos" method="post" action="../Funcionais/AdEquipamento.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                            <div class="form-group">
                                                <label>Nome:</label>
                                                <input type="text" class="form-control" name="nome_equipamento" required>
                                            </div>
                                            
                                            <div class="form-group" hidden>
                                                <label>Sigla:</label>
                                                <input type="text" class="form-control" name="sigla" value="<?php echo $sigla; ?>" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Descrição:</label>
                                                <textarea name="desc_equipamento" class="form-control" style="resize: none;" required></textarea>    
                                            </div>
                                            
                                            <div class="form-group">
                                                <label >Início disponibilidade:</label>
                                                <input type="date" class="form-control" name="datainicio_equip" required>
                                                <br/>
                                                <input type="submit" onclick="return validar()" value="Gravar" id="gravar_equipamento" class="btn btn-secondary"/>
                                            </div>

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