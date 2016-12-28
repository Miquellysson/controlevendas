function validaNome(nome){
    if(/^[a-zA-ZãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª' ']+$/.test(nome)){
        return true;
    }
    return false;
}

function apenasNumeros(string) 
{ //Retira caracteres de string, deixa apenas números
    var numsStr = string.replace(/[^0-9]/g,'');
    //return parseInt(numsStr);
    return numsStr;
}

function checkMail(mail){
    var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
    if(typeof(mail) == "string"){
        if(er.test(mail)){ 
            return true; 
        }else{
            return false;
        }
    }else if(typeof(mail) == "object"){
        if(er.test(mail.value)){ 
            return true; 
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function validarSalario(salario){
    if(/^\$?\d+((,.\d{0,1}))?$/.test(salario)){
        return true;
    }
    return false;
}

function validarCadastroFuncionario(){
    var nome = $('#nome').val();
    var telefone_celular = $('#telefone_celular').val();
    var email = $('#email').val();
    var telefone_residencial = $('#telefone_residencial').val();
    var salario = $('#salario').val();
    
    if( nome == '' ){
        alert( 'Favor digite o nome!'  );
        $('#nome').focus();
        return false;
    }else{
        if( validaNome(nome) === false ){
            alert( 'Favor digite um nome válido!'  );
            $('#nome').focus();
            return false;
        }
    } 
        
    
    if( telefone_celular == '' ){
        alert( 'Favor digite o telefone celular!'  );
        $('#telefone_celular').focus();
        return false;
    }else if( telefone_celular != '' ){
        telefone_celular = apenasNumeros(telefone_celular);
        var tamanho = telefone_celular.length;
        if( tamanho != 11 ){
            alert( 'Favor digite um telefone celular válido!'  );
            $('#telefone_celular').focus();
            return false;
        }
        
    }
    
    if( email != '' ){ //Não obrigatório
        if( checkMail(email) == false ){
            alert( 'Favor digite um e-mail válido!'  );
            $('#email').focus();
            return false;
        }
    }
    
    if( telefone_residencial != '' ){ //Não obrigatório
        telefone_residencial = apenasNumeros(telefone_residencial);
        var tamanho = telefone_residencial.length;
        if( tamanho != 10 ){
            alert( 'Favor digite um telefone residencial válido!'  );
            $('#telefone_residencial').focus();
            return false;
        }
        
    }
    
    if( salario !=  '' ){ //Não obrigatório
        if( validarSalario(salario) == false ){
            alert( 'Favor digite um salário válido!' );
            $('#salario').focus();
            return false;
        }
    }
    
    return true;
}

$(document).ready(function(){
    
    $("[data-mask]").inputmask();
    
    $("#cadastro_funcionario").submit(function(){
        return validarCadastroFuncionario();
    });
    
    
    $("#nome").keydown(function(event) {
        //alert(event.keyCode);
        var tecla = (window.event) ? event.keyCode : event.which;
        if ((tecla > 47 && tecla < 58) || tecla == 9){ 
            return false; 
        }else { 
            return true;
            //if (tecla != 8) 
            //    return false; 
            //else return true; 
        } 

    });
    
});


