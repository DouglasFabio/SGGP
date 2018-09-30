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
                                                                
   if($resultado->num_rows > 0){
       
        $saida = $resultado->fetch_assoc();
       
        $busca2 = "SELECT `nome` FROM `tb_lideres` WHERE `lider` = '". $saida['lider']."'";
        $resultado2 = $conexao->query($busca2);
        $saida2 = $resultado2->fetch_assoc();
    
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
              <h1><?php echo $sigla; ?></h1>
              <h2 class="post-title" style="font-family: Kodchasan;"><?php echo $saida['nome']; ?></h2>
                <br>
              <h2 class="post-title" style="font-family: Kodchasan;"><?php echo $saida2['nome']; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            
          </div>
        </div>
      </div>
    <!-- Footer --> 
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
              
              <h3 class="post-subtitle" style="text-align: justify; font-weight: normal; font-family:\'Open Sans\',\'Helvetica Neue\',Helvetica,Arial,sans-serif">
                 <?php echo $saida['descricao']; ?>
              </h3>
              <br>
              <p class="post-meta"> Veja o currículo completo: <a target = "_top" href="http://<?php echo $saida['link']; ?>"> <?php echo $saida['link']; ?> </a>                  
              </p>
              <br>
              <p class="post-meta"> Grupo ativo desde: <?php echo $saida['data_inicio']; ?>                 
              </p>
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