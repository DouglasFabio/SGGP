<script language="javascript" type="text/javascript">
function validar() {
    var nome = formCadTecnicos.nome_tecnico.value;
    var link = formCadTecnicos.link_tecnico.value;
    var atividade = formCadTecnicos.atividade_tecnico.value;
    var formacao = formCadTecnicos.formacao_academica.value;
    var nome_curso = formCadTecnicos.nome_curso.value;
    var ano_curso = formCadTecnicos.ano_curso.value;
    var foto = formCadTecnicos.arquivo.value;
   

    if (nome == "") {
        alert('Preencha o campo NOME');
        formCadTecnicos.nome_tecnico.focus();
        return false;
    }

    if (link == "") {
        alert('Preencha o campo LINK');
        formCadTecnicos.link_tecnico.focus();
        return false;
    }

    if (atividade == "") {
        alert('Preencha o campo ATIVIDADE');
        formCadTecnicos.atividade_tecnico.focus();
        return false;
    }
    
    if (formacao == "") {
        alert('Preencha o campo FORMAÇÃO ACADÊMICA');
        formCadTecnicos.formacao_academica.focus();
        return false;
    }
    
    if(formacao == 3 || formacao == 4 || formacao == 5 || formacao == 6){
        if (nome_curso == "") {
            alert('Preencha o campo NOME CURSO');
            formCadTecnicos.nome_curso.focus();
            return false;
        }
    
        if (ano_curso == "") {
            alert('Preencha o ANO CURSO');
            formCadTecnicos.ano_curso.focus();
            return false;
        }    
    } 
    if (foto == "") {
        alert('Insira uma foto');
        formCadTecnicos.arquivo.focus();
        return false;
    }
}
</script>
