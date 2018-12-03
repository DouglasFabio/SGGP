<!DOCTYPE html>
<html lang="en">
    <?php
        if (!isset($_SESSION)) session_start();
        if (!isset($_SESSION['LiderLogin'])&&!isset($_SESSION['AdmLogin'])) {
            session_destroy();
            header("Location: ../Visuais/Login.php"); exit;
        }
        include("../Uteis/HeadLogin.php");
    ?>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-50 p-b-90">
                <form name="formADM" method="post" action="../Funcionais/VerificaDadosTrocaSenha.php"class="login100-form validate-form flex-sb flex-w">
                    <span class="login100-form-title p-b-51">
                        Bem-vindo ao SGGP
                        <br><br>
                        <center><h6>Altere sua senha</h6></center>
                    </span>
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Senha é obrigatória">
                        <input class="input100" type="password" name="senha" id="senha" placeholder="Senha" required>
                        <span class="focus-input100"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Senha é obrigatória">
                        <input class="input100" type="password" name="confsenha" id="confsenha" placeholder="Repita a senha" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        include("../Uteis/ScriptsLogin.php");
    ?>
    
    <!-- Modal Dados Invalido -->
    <?php
          include("../Funcionais/Modais.php");
          if(isset($_GET['erro'])){
              if($_GET['erro'] == 1){
                 ModalOKCancelar("Senha Inválida", "A senha deve conter pelo menos um caractér especial, uma letra minúscula, uma letra maiúscula, um número e entre 8 e 12 digitos. ", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 2){
                 ModalOKCancelar("Senhas não Conferem", "As senhas inseridas são divergentes.", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 3){
                 ModalOKCancelar("Problemas", "Problemas na alteração de senha", "erroModal", "#", 'data-dismiss="modal"');
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