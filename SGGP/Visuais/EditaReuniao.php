<!DOCTYPE html>
<html dir="pag" lang="en">  
<?php
    if (!isset($_SESSION)) session_start();
    
    if(!isset($_SESSION['LiderLogin'])){   
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
                        <h4 class="page-title">Manutenção das Reuniões</h4>    
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
                <?php
                    include("../Uteis/ScriptValidaInfoGrupos.php");
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <!-- <h5 class="card-subtitle"> FORMULÁRIO DE CADASTRO DE LIDERES </h5> -->
                            <form name="formEdReunioes" method="post" action="../Funcionais/EdReuniao.php" enctype="multipart/form-data" class="form-horizontal m-t-30">
                                    <?php
                                    $sigla = $_POST['sigla']; 
                                    $id    = $_POST['id'];
                                    $busca = "SELECT id, data, inicio_previsao, pauta  FROM tb_reunioes WHERE id='".$id."'";

                                    if ($resultado = $conexao->prepare($busca)) {
                                        $resultado->execute();
                                        $resultado->bind_result($id, $data, $inicio_previsao, $pauta);

                                        if($resultado->fetch()) {
                                    ?>
                                            <div class="form-group">
                                                <label >Data:</label>                                  
                                                <?php
                                                    printf('<input type="date" class="form-control" id="data" name="data_reuniao" maxlength="50" value="'.$data.'">');
                                                ?>  
                                            </div>
                                            <div class="form-group" hidden>
                                                <label >Sigla:</label>                                  
                                                <?php
                                                    printf('<input type="text" class="form-control" id="sigla" name="sigla" maxlength="10" value="'.$sigla.'">');
                                                ?>  
                                            </div>
                                            <div class="form-group" hidden>
                                                <label >ID:</label>                                  
                                                <?php
                                                    printf('<input type="text" class="form-control" id="id" name="id" value="'.$id.'">');
                                                ?>  
                                            </div>
                                            <div class="form-group"> 
                                                <label>Horário de início (previsão):</label>
                                                <?php
                                                    printf('<input type="time" class="form-control" id="horaprev_reuniao" name="horaprev_reuniao" maxlength="50" value="'.$inicio_previsao.'">');
                                                ?>
                                            </div>
                                            <div class="form-group"> 
                                                <label>Pauta:</label>
                                                <?php
                                                    printf(' <textarea style="resize: none;" class="form-control" rows="5" id="pauta" name="pauta_reuniao">'.$pauta.'</textarea>');
                                                ?>
                                            </div>
                                            <?php
                                        }

                                    }
                                    else {
                                        printf( "Erro no SQL!");
                                    }
                                    ?>
                                                <br/>
                                                <input type="submit" onclick="return validar()" value="Gravar" id="gravar_grupo" class="btn btn-secondary"/>
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