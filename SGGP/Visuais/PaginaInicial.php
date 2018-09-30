<!DOCTYPE html>
<html lang="en">
 <link href="https://fonts.googleapis.com/css?family=Kodchasan:600i" rel="stylesheet">

    
 <?php
    
    if (!isset($_SESSION)) session_start();
    
	include("../Uteis/HeadPagInicial.php");
    
?>

  <body>

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
              <a class="nav-link" href="PaginaInicial.php">Início</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Grupos de Pesquisa</a>
            </li>
            <li class="nav-item">
                <?php
                    if(isset($_SESSION['AdmLogin']) || isset($_SESSION['LiderLogin'])){
                ?>
                        <a class="nav-link" href="Login.php">Painel</a>
                <?php
                    }
                    else{
                ?>
                        <a class="nav-link" href="Login.php">Login</a>
                <?php
                    }
                ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('../Uteis/Botsp_PaginaInicial/img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>SGGP</h1>
              <span class="subheading">Sistema de Gerenciamento de Grupos de Pesquisa</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php
            
                include("../BancoDeDados/Conexao.php");
                $conexao = conectar();
                
                $busca = "SELECT `logotipo`, `sigla`, `nome`, `link`, `descricao` FROM `tb_grupospesquisa` WHERE `situacao` = 1";
                
            
                if ($resultado = $conexao->prepare($busca)) {

                    $resultado->execute();

                    $resultado->bind_result($logotipo, $sigla, $nome, $link, $descricao);

                    while ($resultado->fetch()) {
                        printf('<div class="post-preview">
                                    <div><img src="'.$logotipo.'" class="img-thumbnail" style=" max-width:300px; max-height:200px; width: auto; height: auto;"> 
                                         <a href="#" style="font-size: 70px; font-family: Kodchasan; text-decoration:none;"/>
                                            '.$sigla.'
                                    </div>
                                    <h2 class="post-title" style="font-family: Kodchasan;">
                                        '.$nome.'
                                    </h2>
                                    </a>
                                    <h3 class="post-subtitle" style="text-align: justify; font-weight: normal; font-family:\'Open Sans\',\'Helvetica Neue\',Helvetica,Arial,sans-serif">
                                        '.$descricao.'
                                    </h3>
                              
                                    <p class="post-meta"> Veja o currículo completo: <a href="http://'.$link.'"> '.$link.'</a>
                                        
                                    </p>
                                    
                                    <form action="../Grupos/'.$sigla.'" method="post">
                                        <input value="'.$sigla.'" name= "sigla" id = "sigla" hidden>
                                        <div style="text-align: right;">
                                        <button type="submit" class="btn btn-outline-info" style="color: #0085a1;">VER MAIS</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>');

                    }

                }
                else {

                    printf( "Erro no SQL!");

                }

                $resultado->close();
                
            ?>
          </div>
        </div>
      </div>
    <!-- Footer --> 
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
          
            <p class="copyright text-muted">Desenvolvido por SGGP. &copy; Todos os direitos reservados.</p>
          </div>
        </div>
      </div>
    </footer>

 <?php

	include("../Uteis/ScriptsPagInicial.php");

?>


  </body>

</html>
