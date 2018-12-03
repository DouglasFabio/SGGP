<?php 

function busca($id){
                $conexao = new mysqli("localhost", "root", "toor", "bd_sggp");
                mysqli_set_charset( $conexao, 'utf8');
                
                $busca = "SELECT DISTINCT nome FROM tb_grupospesquisa WHERE year(data_inicio) <= ".$id." AND situacao = 1 ORDER BY data_inicio";
                $result = $conexao->query($busca);
                while($row = $result->fetch_array())
                {
                    $rows[] = $row;
                }
                return $rows;            
}

    $busca = "SELECT DISTINCT year(data_inicio) FROM tb_grupospesquisa WHERE situacao = 1 ORDER BY data_inicio";

    if ($resultado = $conexao->prepare($busca)) {
        $resultado->execute();
        $resultado->bind_result($nome);
        
        printf('<script>
            var json_cidades = {
                "estados": [');
        
        if($resultado->fetch()) {
            printf('{"sigla": "'.$nome.'",
                        "nome": "'.$nome.'",
                        "cidades": [');
                $linhas = busca($nome);
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
            printf(',{"sigla": "'.$nome.'",
                        "nome": "'.$nome.'",
                        "cidades": [');
                $linhas = busca($nome);
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