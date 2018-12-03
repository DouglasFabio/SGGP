<?php
error_reporting(0);
ini_set(“display_errors”, 0 );
?>

<!DOCTYPE html>

<html lang="en">
    
    <?php

        include("../Uteis/HeadLogin.php");

    ?>
    
    <body>
        
        <div class="limiter">
            
            <div class="container-login100">
                
                <div class="wrap-login100 p-t-50 p-b-90">

                    <form name="formLoginLider" method="post" action="../gera_link.php" class="login100-form validate-form flex-sb flex-w">
                        
                        <span class="login100-form-title p-b-51">
                            
                            EMAIL ENVIADO!

                        </span>
                        
                        <a href="../Visuais/Painel.php" class="login100-form-btn">
                            Voltar
                        </a>

                    </form>


                </div>
                
            </div>
            
        </div>
        
        <?php

            include("../Uteis/ScriptsLogin.php");

        ?>

    </body>
    
</html>