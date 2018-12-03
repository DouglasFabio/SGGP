<!DOCTYPE html>
<html dir="pag" lang="en">
    <?php
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['AdmLogin']) && !isset($_SESSION['LiderLogin'])) {
            session_destroy();
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
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" style="padding-left: 30%; padding-right: 30%">
                <div class="card card-body">
                    <h4 class="card-title">Atualize seus dados</h4>
                    <form class="form-horizontal m-t-30" enctype="multipart/form-data" action="../Funcionais/AtualizaPALider.php" method="post">
                        <div class="form-group">
                            <label>Nova Senha</label>
                            <input type="password" class="form-control" placeholder="Senha" id="senha" name="senha" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Repita a Senha</label>
                            <input type="password" class="form-control" placeholder="Confirmar a Senha" id="confsenha" name="confsenha" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Link Lattes</label>
                            <input type="text" class="form-control" placeholder="Link Lattes" name="link" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Carregue uma foto</label>
                            <input type="file" class="form-control" name="arquivo" required>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-outline-primary">Confirma</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        include("../Uteis/ScriptsPainel.php");
    ?>
    <!-- Modal Dados Ivalido -->
    <?php
          include("../Funcionais/Modais.php");
          if(isset($_GET['erro'])){
              if($_GET['erro'] == 1){
                 ModalOKCancelar("Senhas não Conferem", "As senhas inseridas são divergentes.", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 2){
                 ModalOKCancelar("Imagem", "Arquivop grande demais.", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 3){
                 ModalOKCancelar("Arquivo", "O arquivo não é uma imagem.", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 4){
                 ModalOKCancelar("Arquivo", "Problemas para salvar a imagem", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 5 || $_GET['erro'] == 6){
                 ModalOKCancelar("Erro no Update", "Erro no Update.", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 7){
                 ModalOKCancelar("Senha Inválida", "A senha deve conter pelo menos um caractér especial, uma letra minúscula, uma letra maiúscula, um número e entre 8 e 12 digitos. ", "erroModal", "#", 'data-dismiss="modal"');
              }
              
            }
          
      
          if(isset($_GET['erro'])){
                print("
                <script>
                    $(document).ready(function(){
                        $('#erroModal').modal('show');
                    });
                </script>");
            }
    ?>
</body>    
</html>