<!DOCTYPE html>

<html lang="en">
    
    <?php

        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['LiderLogin'])) {


          header("Location: ../Visuais/Painel.php"); exit;

        }

        include("../Uteis/HeadLogin.php");
    
        if(isset($_GET['erro'])){
            echo "<script>window.alert(\"Por favor, selecione um líder!!\");</script>";
        } 

    ?>
    <body>
        
        <div class="limiter">
            
            <div class="container-login100">
                
                <div class="wrap-login100 p-t-50 p-b-90">
                    
                    <form name="formTrocaLider" method="post" action="../Funcionais/VerificaDadosTrocaLider.php"class="login100-form validate-form flex-sb flex-w">
                        
                        <span class="login100-form-title p-b-51">
                            
                            Transferência de Liderança do Grupo de Pesquisa
                            
                            <br><br>
                            
                            <center><h6>Selecione abaixo o novo líder:</h6></center>
                            
                            <?php
                            
                                include("../BancoDeDados/Conexao.php");
                                $conexao = conectar();  
                            
                            ?>
                            
                        </span>
                        
                        <div class="wrap-input100 validate-input m-b-16" data-validate = "Escolha o líder!">
                            
                            <select class="form-control" name="lider_grupo">
                                        <option selected>Escolha</option>
                                        <?php
                                
                                            $sigla = $_POST['sigla'];
                                            $lider_antigo = $_SESSION['LiderLogin'];
                                                    
                                            $busca = "SELECT nome, lider FROM tb_lideres";

                                            if ($resultado = $conexao->prepare($busca)) {
                                                $resultado->execute();
                                                $resultado->bind_result($nome, $lider);

                                                while ($resultado->fetch()) {
                                                    if($lider_antigo != $lider)
                                                    printf('<option value="'.$lider.'">'.$nome.'</option>');
                                                }

                                            }
                                            else {
                                                printf( "Erro no SQL!");
                                            }

                                            $resultado->close();

                                        ?>  
                                        </select>
                                        <input type="text" name="sigla" value="<?php echo $sigla; ?>" hidden/>
                            
                            <span class="focus-input100"></span>
                            
                        </div>

                        <div class="container-login100-form-btn m-t-17">
                            
                            <button class="login100-form-btn">
                                
                            Transferir
                                
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