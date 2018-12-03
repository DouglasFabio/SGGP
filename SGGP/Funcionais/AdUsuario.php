<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
    if (!isset($_SESSION)) session_start();
    if (!isset($_SESSION['AdmLogin'])) {
        header("Location: ../Visuais/Painel.php"); exit;
    }
    include("../Uteis/HeadPainel.php");
 
?>

    <?php

        include("../BancoDeDados/Conexao.php");
        $conexao = conectar();

        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');

        $prontuario = $_POST['prontuario_lider'];
        $nome       = $_POST['nome_lider'];
        $email      = $_POST['email_lider'];

        include("../Funcionais/GeraSenha.php");
        $palavra  = geraSenha();

        $senhaCrip = hash('sha256', $palavra);
        if (!empty($error)){
            echo $error;
        }

        if(strlen($prontuario) > 20){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }

        else if(empty($prontuario)){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");    
        }

        else if(empty($nome)){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }

        else if(strlen($nome) > 50){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }

        else if(empty($email)){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }

        else if(strlen($email) > 50){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            printf("<script>
                        $(document).ready(function(){
                            $('#erro').modal('show');
                        });
                    </script>");
        }
    ?>
    <form action="../Visuais/CadUsuario.php" method="post">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Usuário cadastrado com sucesso!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <input name="sigla" value="<?php echo $sigla; ?>" hidden>
              <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">OK</button>
              </div>
            </div>
          </div>
        </div>
    </form>

    <form action="../Visuais/CadUsuario.php" method="post">
        <div class="modal fade" id="erro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Problemas nos dados informados!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <input name="sigla" value="<?php echo $sigla; ?>" hidden>
              <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">OK</button>
              </div>
            </div>
          </div>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php
        include("../Uteis/ScriptsPainel.php");
        $insereUsuarios = "INSERT INTO `tb_usuarios` (`login`, `email`, `senha`, `data`, `tipo`, `acesso`) 
                                              VALUES ('$prontuario', '$email', '$senhaCrip', '$data', 1, 0);";
        $insereLideres  = "INSERT INTO `tb_lideres` (`lider`,`nome`)
                                             VALUES ('$prontuario', '$nome');";

        if ($conexao->query($insereUsuarios) === TRUE && $conexao->query($insereLideres)) {
            $mensagem = "Sua senha: ".$palavra;

            include("../Funcionais/Email.php");

            enviarEmail($email, $mensagem);
            printf("<script>
                    $(document).ready(function(){
                    $('#myModal').modal('show');
                    });
                    </script>");
        }
        else{
            printf("<script>
                    $(document).ready(function(){
                    $('#erro').modal('show');
                    });
                    </script>");    
        }
        $conexao->close();
    ?>