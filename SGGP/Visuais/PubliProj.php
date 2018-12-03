<!DOCTYPE html>
<html lang="en">
 <link href="https://fonts.googleapis.com/css?family=Kodchasan:600i" rel="stylesheet">

 <?php
    
    if (!isset($_SESSION)) session_start();
    
	include("../Uteis/HeadPagInicial.php");
    
    $sigla = $_SESSION['sigla'];
    
    include("../BancoDeDados/Conexao.php");
    $conexao = conectar();

    $busca = "SELECT `logotipo`, `nome`, `link`, `descricao`, `data_inicio`, `lider`, `email` FROM `tb_grupospesquisa` WHERE `sigla` = '". $sigla."'";


   $resultado = $conexao->query($busca);
   $id = $_POST['proj'];                                                        
   if($resultado->num_rows > 0){
       
        $saida = $resultado->fetch_assoc();

?>

  <body style="background-color: #ffffff">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="../Visuais/PaginaInicial.php" target = "_top">Início</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" target = "_top">Grupos de Pesquisa</a>
            </li>
            <li class="nav-item">
                <?php
                    if(isset($_SESSION['AdmLogin']) || isset($_SESSION['LiderLogin'])){
                ?>
                        <a class="nav-link" href="../Visuais/Login.php" target = "_top">Painel</a>
                <?php
                    }
                    else{
                ?>
                        <a class="nav-link" href="../Visuais/Login.php" target = "_top">Login</a>
                <?php
                    }
                ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
      
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('<?php echo $saida['logotipo']; ?>')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <img class="img-thumbnail" style=" max-width:300px; max-height:200px; width: auto; height: auto;" src="<?php echo $saida['logotipo']; ?>" alt="">
              <h1>Grupo: <?php echo $sigla; ?></h1>
              <h2 class="post-title" style="font-family: Kodchasan;">Projeto: <?php 
                  $busca2 = "SELECT titulo FROM `tb_projetospesquisa` WHERE id = '".$id."'";

                            if ($resultado2 = $conexao->prepare($busca2)) {

                                $resultado2->execute();

                                $resultado2->bind_result($nome);

                                while ($resultado2->fetch()) {
                                        echo $nome;
                                    
                                }   
                            }
                            else {
                                printf( "Erro no SQL!");
                            }
                            $resultado2->close();
                  
                  ?></h2>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Footer --> 
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
              
              <p class="post-meta"> Publicações do Projeto                
              </p>
              <table class="table table-hover">
                               
                    <thead>
                        <tr>
                            <th scope="col">Referência</th>
                        </tr>
                    </thead>
                  <tbody>
                       <?php

                        $busca = "SELECT referencia FROM `tb_publicacoes` WHERE projeto = '".$id."' ORDER BY data DESC";

                            if ($resultado = $conexao->prepare($busca)) {

                                $resultado->execute();

                                $resultado->bind_result($ref);

                                while ($resultado->fetch()) {
                                        printf('<tr>
                                                <td>'.$ref.'</td>
                                                </tr>');
                                    
                                }   
                            }
                            else {
                                printf( "Erro no SQL!");
                            }
                            $resultado->close();   
                        ?>
                </tbody>
                  
                </table>
              
              
            <p class="copyright text-muted">Desenvolvido por SGGP. &copy; Todos os direitos reservados.</p>
          </div>
        </div>
      </div>
        
    </footer>

 <?php
   }
	include("../Uteis/ScriptsPagInicial.php");

?>


  </body>

</html>
