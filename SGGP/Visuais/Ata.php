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
              <a class="nav-link" href="PaginaInicial.php"target = "_top">Início</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"target = "_top">Grupos de Pesquisa</a>
            </li>
            <li class="nav-item">
                <?php
                    if(isset($_SESSION['AdmLogin']) || isset($_SESSION['LiderLogin'])){
                ?>
                        <a class="nav-link" href="Login.php" target = "_top">Painel</a>
                <?php
                    }
                    else{
                ?>
                        <a class="nav-link" href="Login.php" target = "_top">Login</a>
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
            <h5 class="post-meta"> ATA e participantes da Reunião                
              </h5>
                <br>
              <table class="table table-hover">

                    <thead>
                        <tr>
                            <th scope="col">ATA</th>
                        </tr>
                    </thead>
                  <tbody>

            <?php
                include("../BancoDeDados/Conexao.php");
                $conexao = conectar();

                $id = $_POST['reuniao'];

                $busca = "SELECT r.ata, p.nome FROM tb_reunioes AS r INNER JOIN tb_partreunioes AS pr ON r.id = pr.reuniao INNER JOIN tb_participantes AS p ON pr.docente = p.id WHERE r.id = ".$id."; ";

                if ($resultado = $conexao->prepare($busca)) {

                    $resultado->execute();

                    $resultado->bind_result($ata, $nome);

                    if ($resultado->fetch()) {
                        printf('<tr><td>'.$ata.'</td></tr>
                            </tbody>

                        <thead>
                            <tr>
                                <th scope="col">Nome dos Participantes</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr><td>'.$nome.'</td></tr>
                        ');
                    } 
                    while ($resultado->fetch()) {
                        printf('<tr><td>'.$nome.'</td></tr>');
                    }   
                }
                else {
                    printf( "Erro no SQL!");
                }
                $resultado->close(); 

            ?>

            </tbody>

            </table>
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
