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
                            <br>
                            <br>
                            <center><h6>Para acessar, crie um Administrador</h6></center>
                            
                             <?php
                            
                               if(isset($_GET['erro'])){
                                   echo "<script>window.alert(\"Senhas não conferem!\");</script>";
                               } 
                            
                             ?>
                             
                        </span>


                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Login é obrigatório">
                            <input class="input100" type="text" name="loginADM" id="loginADM" placeholder="Login">
                            <span class="focus-input100"></span>
                        </div>
                        
                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Email é obrigatório">
                            <input class="input100" type="email" name="emailADM" id="emailADM" placeholder="Email">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Senha é obrigatória">
                            <input class="input100" type="password" name="senhaADM" id="senhaADM" placeholder="Senha" required>
                            <span class="focus-input100"></span>
                        </div>
                        
                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Senha é obrigatória">
                            <input class="input100" type="password" name="confsenhaADM" id="confsenhaADM" placeholder="Repita a senha" required>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="container-login100-form-btn m-t-17">
                            <button class="login100-form-btn">
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
    
    </body>

</html>