<!DOCTYPE html>
<html dir="pag" lang="en">
    <?php
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['AdmLogin'])) {
            header("Location: Painel.php"); exit;
        }
        include("../Uteis/HeadPainel.php");
    ?>
<body>
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
                        <h4 class="page-title">Cadastro de Grupos de Pesquisa</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">SGGP</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Cadastrar Grupos de Pesquisa</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <?php
                    include("../Uteis/ScriptValidaCadGrupos.php");
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4 class="card-title">Grupo de Pesquisa</h4>
                            <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                            <form name="formCadGrupos" method="post" action="../Funcionais/AdGrupo.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                <div class="form-group"> 
                                    <label>Nome:</label>
                                    <input  type="text" class="form-control" name="nome_grupo" maxlength="50" required>  
                                </div>
                                
                                <div class="form-group">
                                    <label>Sigla:</label>
                                    <input type="text" class="form-control" name="sigla_grupo" maxlength="10" required>
                                </div>
                                    
                                <div class="form-group">
                                    <label >Líder:</label>
                                    <select class="form-control" name="lider_grupo" required>
                                    <option value="">Escolha</option>
                                    <?php
                                        $busca = "SELECT nome FROM tb_lideres";
                                        
                                        if ($resultado = $conexao->prepare($busca)){
                                            $resultado->execute();
                                            $resultado->bind_result($nome);
                                            
                                            while ($resultado->fetch()) {
                                                printf('<option value="'.$nome.'">'.$nome.'</option>');
                                            }
                                        }
                                        else{
                                            printf( "Erro no SQL!");
                                        }
                                        $resultado->close();
                                    ?>  
                                    </select>
                                    <br/>
                                    <input type="submit" onclick="return validar()" value="Gravar" id="gravar_lider" class="btn btn-secondary"/>
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