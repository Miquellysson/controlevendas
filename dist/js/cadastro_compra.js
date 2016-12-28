function adicionar(){
    var val1 = $("#produto option:selected").val();
    var text1 = $("#produto option:selected").text();

    if( val1 != '' ){
        var qtd = $("#quantidade").val();
        if( qtd == '0' ){
            alert('Não é possível comprar o produto, pois não é possível comprar zero produtos!');
            return false;
        }else if( qtd != '' ){
            var val = val1+'-'+qtd;
            $("#produtos").append('<option value='+val+'>'+ text1+' - '+qtd+ '</option>');
            $("#produto option:selected").remove();
            $("#quantidade").val('');
        }else{
            alert('Selecione a quantidade!');
        }
    }else{
        alert('Selecione o produto!');
    }
    return false;
}

function remover(){
    $( "#produtos option:selected" ).each(function() {
        var pos = '';
        var val = $( this ).val();
        pos = val.lastIndexOf("-");
        val = val.substring( 0, pos-1 ); //Retirando quantidade
        var text = $( this ).text();
        pos = text.lastIndexOf("-");
        text = text.substring( 0, pos-2 ); //Retirando quantidade
        
        $("#produto").append('<option value='+val+'>'+ text+ '</option>');
        $(this).remove();
    });

    return false;
}

function selecionaTodasAsOptions(){	
    var produtos = document.getElementById("produtos");	
    var tam = produtos.options.length;

    for( var i = 0 ; i< tam; i++ ){		
        produtos.options[i].selected = 1; 
    }

}

$(document).ready(function(){
    $("#adicionar").click(function(){
        return adicionar();
    });

    $("#remover").click(function(){
        return remover();
    });

    /*$("#produto").change(function(){
        return obterQuantidade();
    });*/

    $("#cadastro_compra").submit(function(){
        selecionaTodasAsOptions();
    });
    
    $("#quantidade").keypress(function(event) {
        var tecla = (window.event) ? event.keyCode : event.which;
        if ( (tecla > 47 && tecla < 58) || tecla == 0 || tecla == 8 ){ 
            return true; 
        }else { 
            return false; 
        } 

    });
   
});