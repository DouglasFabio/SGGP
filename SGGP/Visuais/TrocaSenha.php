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
                            
                            <?php
                            
                                if(isset($_GET['erro']) == 1){
                                   echo "<script>window.alert(\"Login ou Senha Inválidos!\");</script>";
                                } 
                                else if(isset($_GET['erro']) == 2){
                                   echo "<script>window.alert(\"Senhas divergentes!\");</script>";
                                } 
                            
                            ?>
                            
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

    </body>
    
</html>