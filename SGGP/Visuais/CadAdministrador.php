<!DOCTYPE html>
<html lang="en">
<?php
    include("../Funcionais/PrimeiroAcesso.php");
    include("../Uteis/HeadLogin.php");
?>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-50 p-b-90">
                <form name="formADM" method="post" action="../Funcionais/VerificaDadosAdm.php"class="login100-form validate-form flex-sb flex-w">
                    <span class="login100-form-title p-b-51">
                        Bem-vindo ao SGGP
                        <br><br>
                        <center><h6>Para acessar, crie um Administrador</h6><br/>
                            <h6><i>Requer senha forte: 1 Maiúscula, 1 Minuscula, 1 número e 1 caracter</i></h6>
                        </center>          
                    </span>
                    
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Login é obrigatório" required>
                        <input class="input100" type="text" name="loginADM" id="loginADM" placeholder="Login" maxlength="20">
                        <span class="focus-input100"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Email é obrigatório">
                        <input class="input100" type="email" name="emailADM" id="emailADM" placeholder="Email" maxlength="50">
                        <span class="focus-input100"></span>
                    </div>
                    
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Senha é obrigatória">
                        <input class="input100" type="password" name="senhaADM" id="senhaADM" placeholder="Senha" maxlength="64">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Senha é obrigatória">
                        <input class="input100" type="password" name="confsenhaADM" id="confsenhaADM" placeholder="Repita a senha" maxlength="64">
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button  class="login100-form-btn">
                            Criar
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
                 ModalOKCancelar("Usuário", "O usuário digitado é muito grande.", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 2){
                 ModalOKCancelar("Email", "O email digitado é muito grande.", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 3){
                 ModalOKCancelar("Senha Inválida", "A senha deve conter pelo menos um caractér especial, uma letra minúscula, uma letra maiúscula, um número e entre 8 e 12 digitos. ", "erroModal", "#", 'data-dismiss="modal"');
              }
              else if($_GET['erro'] == 4){
                 ModalOKCancelar("Senhas não Conferem", "As senhas inseridas são divergentes.", "erroModal", "#", 'data-dismiss="modal"');
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