function validarRelatorioVenda(){
    var cliente = $('#cliente').val();
    var funcionario = $('#funcionario').val();
    var periodo = $('#periodo').val();
    
    if( cliente == '' && funcionario == '' && periodo == '' ){
        alert('Favor selecione pelo menos um dos parâmetros!');
        return false;
    }
    
    return true;
}

$(document).ready(function(){
    
    $(function () {
        //Date range picker
        $('#periodo').daterangepicker();
    });
    
    $("#relatorio_venda").submit(function(){
        return validarRelatorioVenda();
    });
    
    
});





