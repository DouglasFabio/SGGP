<!DOCTYPE html>
<html dir="ltr" lang="en">

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
                            <h4 class="page-title">Controle de permissões</h4>
                        </div>
                        <div class="col-7 align-self-center">
                            <div class="d-flex align-items-center justify-content-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#">SGGP</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Controle de Permissões</li>
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
                                    <h4 class="card-title">Controle de permissões</h4>
                                    <h6 class="card-title m-t-40">
                                      <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>
                                      Gerenciamento de ADMINISTRADORES:
                                    </h6>
                                    <form name="formPermissoes" method="post" action="../Funcionais/Permissoes.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Ação</th>
                                                        <th scope="col">Permissão</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                       <?php

                                                            $busca = "SELECT cdusuarios, permissoes FROM tb_permissoes WHERE id = 0";

                                                            $resultado = $conexao->query($busca);

                                                            if ($resultado->num_rows > 0) {

                                                                $saida = $resultado->fetch_assoc();

                                                                if($saida['cdusuarios'] == 1) {

                                                                    printf('<tr><td>Cadastrar Usuários</td>
                                                                        <td><input type="checkbox" name="cdusuariosA" value="true" checked></td>
                                                                    </tr>');

                                                                }
                                                                else{

                                                                     printf('<tr><td>Cadastrar Usuários</td>
                                                                        <td><input type="checkbox" name="cdusuariosA" value="true"></td>
                                                                    </tr>');

                                                                }
                                                                if($saida['permissoes'] == 1) {

                                                                    printf('<tr><td>Modificar Permissões</td>
                                                                        <td><input type="checkbox" name="permissoesA" value="true" checked></td>
                                                                    </tr>');

                                                                }
                                                                else{

                                                                     printf('<tr><td>Modificar Permissões</td>
                                                                        <td><input type="checkbox" name="permissoesA" value="true"></td>
                                                                    </tr>');

                                                                }

                                                            }

                                                            $resultado->close();

                                                        ?>

                                                </tbody>
                                            </table>
                                            <h6 class="card-title m-t-40">
                                              <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>
                                              Gerenciamento de LIDERES:
                                            </h6>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Ação</th>
                                                        <th scope="col">Permissão</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                       <?php

                                                            $busca2 = "SELECT cdusuarios, permissoes FROM tb_permissoes WHERE id = 1";

                                                            $resultado = $conexao->query($busca2);

                                                            if ($resultado->num_rows > 0) {

                                                                $saida = $resultado->fetch_assoc();

                                                                if($saida['cdusuarios'] == 1) {

                                                                    printf('<tr><td>Cadastrar Usuários</td>
                                                                        <td><input type="checkbox" name="cdusuariosL" value="true" checked></td>
                                                                    </tr>');

                                                                }
                                                                else{

                                                                     printf('<tr><td>Cadastrar Usuários</td>
                                                                        <td><input type="checkbox" name="cdusuariosL" value="true"></td>
                                                                    </tr>');

                                                                }
                                                                if($saida['permissoes'] == 1) {

                                                                    printf('<tr><td>Modificar Permissões</td>
                                                                        <td><input type="checkbox" name="permissoesL" value="true" checked></td>
                                                                    </tr>');

                                                                }
                                                                else{

                                                                     printf('<tr><td>Modificar Permissões</td>
                                                                        <td><input type="checkbox" name="permissoesL" value="true"></td>
                                                                    </tr>');

                                                                }

                                                            }

                                                            $resultado->close();
                                                            $conexao->close();

                                                        ?>

                                                </tbody>
                                        </table>
                                        <input type="submit" onclick="return validar()" value="Gravar" id="gravar_lider" class="btn btn-secondary"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               
                <footer class="footer text-center">
                   
                    Todos os direitos reservados por SGGP. Desenvolvido por
                    <a href="https://wrappixel.com">SGGP</a>.
                    
                </footer>
                
        </div>
        
        </div>
        
        <?php

            include("../Uteis/ScriptsPainel.php");

        ?>

    </body>

</html>