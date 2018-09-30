<!DOCTYPE html>

<html lang="en">
    
    <?php

        include("../Uteis/HeadLogin.php");

    ?>
    
    <body>

        <div class="limiter">
            
            <div class="container-login100">
                
                <div class="wrap-login100 p-t-50 p-b-90">

                    <form name="formEsqueceuSenha" method="post" action="../Funcionais/GeraLink.php" class="login100-form validate-form flex-sb flex-w">
                        
                        <span class="login100-form-title p-b-51">
                            
                            Digite seu Prontuario!
                            
                            <?php
                            
                               if(isset($_GET['erro'])){
                                   echo "<script>window.alert(\"Prontuário Inválido!\");</script>";
                               } 
                            
                            ?>
                            
                        </span>

                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Verifique seu prontuário">
                            
                            <input class="input100" type="text" name="prontuario" id="prontuario" placeholder="Prontuário">
                            
                            <span class="focus-input100"></span>
                            
                        </div>

                        <div class="container-login100-form-btn m-t-17">
                            
                            <button class="login100-form-btn">
                                
                                Enviar E-mail de recuperação
                                
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