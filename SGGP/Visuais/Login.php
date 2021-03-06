<!DOCTYPE html>

<html lang="en">

    <?php
    
        if (!isset($_SESSION)) session_start();

        if (isset($_SESSION['LiderLogin']) || isset($_SESSION['AdmLogin'])) {

          header("Location: ../Visuais/Painel.php"); exit;

        }
    
        else{
            
            session_destroy();
            
        }
        
    
        include("../Uteis/HeadLogin.php");

    ?>
    <?php
        if(isset($_GET['erro'])){
            $caminho = "../Funcionais/VerificaPrimeiroAcesso.php?erro=".$_GET['erro'];
        }
        else{
            $caminho = "../Funcionais/VerificaPrimeiroAcesso.php";
        }
    ?>

    <body>

        <div class="limiter">
            
            <div class="container-login100">
                
                <div class="wrap-login100 p-t-50 p-b-90">		

                    <form name="formLogin" method="post" action="<?php echo $caminho; ?>" class="login100-form validate-form flex-sb flex-w">
                        
                        <span class="login100-form-title p-b-51">
                            
                            Login SGGP
                            
                        </span>

                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Verifique seu prontuário">
                            
                            <input class="input100" type="text" name="login" id="login" placeholder="Prontuário">
                            
                            <span class="focus-input100"></span>
                            
                        </div>


                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Insira sua senha!">
                            
                            <input class="input100" type="password" name="senha" id="senha" placeholder="Senha">
                            
                            <span class="focus-input100"></span>
                            
                        </div>

                        <div class="flex-sb-m w-full p-t-3 p-b-24">
                            
                            <div class="contact100-form-checkbox">

                            </div>

                            <div>
                                
                                <a href="EsqueceuSenha.php" class="txt1">
                                    
                                    Esqueceu a senha?
                                    
                                </a>
                                
                            </div>
                            
                        </div>

                        <div class="container-login100-form-btn m-t-17">
                            
                            <button class="login100-form-btn">
                                
                                Entrar
                                
                            </button>
                            
                        </div>

                    </form>
                    
                </div>
                
            </div>
            
        </div>

    <?php

        include("../Uteis/ScriptsLogin.php");

    ?>
    <!-- Modal Esqueceu Senha -->
    <?php
        include("../Funcionais/Modais.php");
        ModalOKCancelar("Esqueceu a senha?", "Você deseja recuperar sua senha?", "senhaModal", "../Visual/RecuperarSenha.php","");
    ?> 
      
    <!-- JavaScript -->
    <?php
        include("../Uteis/Script.php");
      
        if(isset($_GET['erro'])){
            if($_GET['erro'] == 5){
                print("
                <script>
                    $(document).ready(function(){
                        $('#senhaModal').modal('show');
                    });
                </script>");
            }
        }
    ?>

    </body>
    
</html>