<script language="javascript" type="text/javascript">
function validar() {
    var nome = formEdCadGrupos.nome_grupo.value;
    var sigla = formEdCadGrupos.sigla_grupo.value;
    var email = formEdCadGrupos.email_grupo.value;
    var link = formEdCadGrupos.link_grupo.value;
    var descricao = formEdCadGrupos.desc_grupo.value;
    var logotipo = formEdCadGrupos.arquivo.value;

    if (nome == "" || nome.length > 50) {
        alert('Corrija o campo NOME.');
        formEdCadGrupos.nome_grupo.focus();
        return false;
    }

    else if (sigla == "" || sigla.length > 10) {
        alert('Corrija o campo SIGLA');
        formEdCadGrupos.sigla_grupo.focus();
        return false;
    }
    
    else if (link == "") {
        alert('Corrija o campo LINK CNPq');
        formEdCadGrupos.link_grupo.focus();
        return false;
    }
    
    else if (descricao == "") {
        alert('Corrija o campo DESCRIÇÃO');
        formEdCadGrupos.desc_grupo.focus();
        return false;
    }
    
    else if (logotipo == "") {
        alert('Preencha o campo LOGOTIPO');
        formEdCadGrupos.arquivo.focus();
        return false;
    }
}
</script>
