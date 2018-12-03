<!DOCTYPE html>
<html dir="pag" lang="en">
<?php
    if (!isset($_SESSION)) session_start();
    if (!isset($_SESSION['AdmLogin'])) {    
        header("Location: PaginaInicial.php"); exit;
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
                        <h4 class="page-title">Cadastro de Postagens</h4>
                    </div>
                    
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">SGGP</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Postagens</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4 class="card-title">Postagens</h4>
                            <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                            <form name="formCadUsuarios" method="post" action="../Funcionais/AdPost.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                <div class="form-group"> 
                                    <label>Descrição:</label>
                                    <textarea style="resize: none;" class="form-control" rows="10" id="post" name="post"></textarea>
                                    
                                </div>
                                <button class="btn btn-secondary">Postar</button>
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