function validarPreco(preco){
    if(/^\$?\d+((,.\d{0,1}))?$/.test(preco)){
        return true;
    }
    return false;
}

function validarCadastroProduto(){
    var descricao = $('#descricao').val();
    var preco_compra = $('#preco_compra').val();
    var preco_venda = $('#preco_venda').val();
    
    if( descricao == '' ){
        alert( 'Favor digite a descriçao!'  );
        $('#descricao').focus();
        return false;
    }else if( !validarPreco(preco_compra) ){
        alert( 'Favor digite o preço de compra válido!'  );
        $('#preco_compra').focus();
        return false;
    }else if( !validarPreco(preco_venda) ){
        alert( 'Favor digite o preço de venda válido!'  );
        $('#preco_venda').focus();
        return false;
    }
    
    return true;
}

$(document).ready(function(){
    
    $("#cadastro_produto").submit(function(){
        return validarCadastroProduto();
    });
    
    
});


