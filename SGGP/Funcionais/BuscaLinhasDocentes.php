<?php 

function busca($id){
                $conexao = new mysqli("localhost", "root", "toor", "bd_sggp");
                mysqli_set_charset( $conexao, 'utf8');
                
                $busca = "SELECT ld.docente, ld.linha_pesquisa, l.nome FROM tb_linhasdocentes as ld INNER JOIN tb_subespecialidades as l ON l.codigo = ld.linha_pesquisa  WHERE ld.docente = ".$id;
                $result = $conexao->query($busca);
                while($row = $result->fetch_array())
                {
                    $rows[] = $row;
                }
                return $rows;            
}

    $busca = "SELECT id, nome FROM tb_participantes WHERE tipo = 1 AND grupo ='".$_POST['sigla']."'";

    if ($resultado = $conexao->prepare($busca)) {
        $resultado->execute();
        $resultado->bind_result($id, $nome);
        
        printf('<script>
            var json_cidades = {
                "estados": [');
        
        if($resultado->fetch()) {
            printf('{"sigla": "'.$id.'",
                        "nome": "'.$nome.'",
                        "cidades": [');
                $linhas = busca($id);
                foreach($linhas as $row){
                    if($row == $linhas[(count($linhas)-1)]){
                        printf ('"'.$row['nome'].'"'); 
                    }else{
                    printf ('"'.$row['nome'].'",'); 
                    }
                }
            printf(']
                    }');
        }
        while ($resultado->fetch()) {
            printf(',{"sigla": "'.$id.'",
                        "nome": "'.$nome.'",
                        "cidades": [');
                $linhas = busca($id);
                foreach($linhas as $row){
                    if($row == $linhas[(count($linhas)-1)]){
                        printf ('"'.$row['nome'].'"'); 
                    }else{
                    printf ('"'.$row['nome'].'",');
                    }
                }
            printf(']
                    }');
        }
        
        printf('
                ]
            };</script>');
         
        
        

    }
    else {
        printf( "Erro no SQL!");
    }

?> 