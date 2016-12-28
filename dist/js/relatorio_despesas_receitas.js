function validarRelatorioDespesasReceitas(){
    var periodo = $('#periodo').val();
    
    if( periodo == '' ){
        alert('Favor selecione o período!');
        return false;
    }
    
    return true;
}

$(document).ready(function(){
    
    $(function () {
        //Date range picker
        $('#periodo').daterangepicker();
    });
    
    $("#despesas_receitas").submit(function(){
        return validarRelatorioDespesasReceitas();
    });
    
    
});





