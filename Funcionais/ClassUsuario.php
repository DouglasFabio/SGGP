<?php
 
    class Lider {

        private $login;
        private $nome;
        private $email;
        private $tipo;
        
        public function CriaSessao($login, $nome, $email, $tipo){
            
          if (!isset($_SESSION)) session_start();
            $_SESSION['LiderLogin'] = $login;
            $_SESSION['LiderNome'] = $nome;
            $_SESSION['LiderEmail'] = $email;
            $_SESSION['LiderTipo'] = $tipo;
        }   
        
    }  

    class Adm {

        private $login;
        private $email;
        private $tipo;
        
        public function CriaSessao($login, $email, $tipo){
            
          if (!isset($_SESSION)) session_start();
            $_SESSION['AdmLogin'] = $login;
            $_SESSION['AdmEmail'] = $email;
            $_SESSION['AdmTipo'] = $tipo;
        }   
        
    }  

?>