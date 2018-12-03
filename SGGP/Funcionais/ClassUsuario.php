<?php
 
    class Lider {

        private $login;
        private $nome;
        private $email;
        private $acesso;
        
        public function CriaSessao($login, $nome, $email, $acesso){
            
          if (!isset($_SESSION)) session_start();
            $_SESSION['LiderLogin'] = $login;
            $_SESSION['LiderNome'] = $nome;
            $_SESSION['LiderEmail'] = $email;
            $_SESSION['LiderAcesso'] = $tipo;
        }   
        
    }  

    class Adm {

        private $login;
        private $email;
        private $acesso;
        
        public function CriaSessao($login, $email, $acesso){
            
          if (!isset($_SESSION)) session_start();
            $_SESSION['AdmLogin'] = $login;
            $_SESSION['AdmEmail'] = $email;
            $_SESSION['AdmAcesso'] = $tipo;
        }   
        
    }  

?>