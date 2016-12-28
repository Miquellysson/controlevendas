function adicionar(){
    var val1 = $("#produto option:selected").val();
    var text1 = $("#produto option:selected").text();

    if( val1 != '' ){
        var qtd = $("#quantidade").val();
        if( qtd == '0' ){
            alert('Não é possível vender o produto, pois não tem no estoque!');
            return false;
        }else if( qtd != '' ){
            var val = val1+'-'+qtd;
            $("#produtos").append('<option value='+val+'>'+ text1+' - '+qtd+ '</option>');
            $("#produto option:selected").remove();
            //qtd.empty(); //Está dando erro 
            //qtd.append("<option value=''>Selecione o produto</option>"); //Está dando erro
            //return false;
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

function obterQuantidade(){
    var produto = $("#produto option:selected").text();
        var pos = produto.lastIndexOf("-");
        var estoque = produto.substring( pos+2 );
        var qtd = $('#quantidade');
        qtd.empty();
        if( estoque == 0 ){
            qtd.append("<option value='0'>Não há estoque do produto</option>");
        }else{
            qtd.append("<option value=''>Selecione a quantidade</option>");
            for( var i = 1; i <= estoque; i++ ){
                qtd.append("<option value="+i+">"+i+"</option>");
            }
        }
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

    $("#produto").change(function(){
        return obterQuantidade();
    });

    $("#cadastro_venda").submit(function(){
        selecionaTodasAsOptions();
    });
   
});






/*
//$("#trocar").click(function(){
//    //var val2 = $("#produtos option:selected").val();
//    //var text2 = $("#produtos option:selected").text();
//    
//    var str = "";
//    $( "#produtos option:selected" ).each(function() {
//      str += $( this ).val()+"  "+$( this ).text() + " ";
//    });
//    alert( str );
//    return false;
//});

//$("#trocar").click(function(){
//    var val1 = $("#sel1 option:selected").val();
//    var text1 = $("#sel1 option:selected").text();
//    //alert(val1+' '+text1);
//    //var val2 = $("#sel2 option:selected").val();
//    //var text2 = $("#sel2 option:selected").text();
//    
//    //$("#sel1 option:selected").val(val2);    
//    //$("#sel1 option:selected").text(text2);
//    //var qtd = $("#quantidade").val();
//    if( val1 != '' ){
//        var qtd = $("#quantidade").val();
//        if( qtd == '0' ){
//            alert('Não é possível vender o produto, pois não tem no estoque!');
//            return false;
//        }else if( qtd != '' ){
//            $("#sel2").append('<option value='+val1+'>'+ text1+' - '+qtd+ '</option>');
//            $("#sel1 option:selected").remove();
//            //qtd.empty();
//            //qtd.append("<option value=''>Selecione o produto</option>");
//            //return false;
//            //$("#sel2 option:selected").val(val1);    
//            //$("#sel2 option:selected").text(text1);
//            //alert( $("#sel1 option:selected").val()+' '+$("#sel2 option:selected").val() );
//        }else{
//            alert('Selecione a quantidade!');
//        }
//    }else{
//        alert('Selecione o produto!');
//    }
//    return false;
//});
//

$("#voltar").click(function(){
    var val2 = $("#sel2 option:selected").val();
    var text2 = $("#sel2 option:selected").text();
    
    var pos = text2.lastIndexOf("-");
    text2 = text2.substring( 0, pos-2 );
    
    //alert(val2+'  '+text2);
    $("#sel1").append('<option value='+val2+'>'+ text2+ '</option>');
    $("#sel2 option:selected").remove();
    //$("#sel1 option:selected").val(val2);    
    //$("#sel1 option:selected").text(text2);
    
    return false;
});

function adicionar(){
   var produto = document.getElementById("produto"); 
   var quantidade = document.getElementById("quantidade");	
   var produtos = document.getElementById("produtos");	
   
   if( produto.value == '' ){
        alert("Selecione o produto!");
   }else if( quantidade.value == '' ){
        alert("Selecione a quantidade!");
   }//else if ( produto.selectedIndex != 0 ){
   else{
        tam = produtos.options.length++;	 // qtd registros do select		
        produtos.options[tam].text = produto.options[document.getElementById("produto").selectedIndex].text+' - '+quantidade.value;  // adicionar novo registro		
        produtos.options[tam].value = produto.value+'-'+quantidade.value; // dar o valor ao registro		
        produtos.options[tam].selected = 1;
        //produto.removeChild( produto[value] );
    }//else{
    //    alert('Selecione o produto que deseja adicionar!');
    //}
   
   return false;
}
                  
function remover(){   
   var select = document.getElementById('produtos');
   value = select.selectedIndex;

   if( value != -1 ){
       select.removeChild( select[value] );
   }else{
       alert('Nao tem produtos a ser removido!');
   }
   return false;
}

function selecionaTodasAsOptions(){	
   var produtos = document.getElementById("produtos");	
   var tam = produtos.options.length;
   		
   for( var i = 0 ; i< tam; i++ ){		
       produtos.options[i].selected = 1; 
   }

}

function obterQuantidade(){
    var produto = document.getElementById("sel1").options[document.getElementById("sel1").selectedIndex].text;
    //var produto = document.getElementById("produto").options[document.getElementById("produto").selectedIndex].text;
    var pos = produto.lastIndexOf("-");
    var estoque = produto.substring( pos+2 );
//    var quantidade = document.getElementById("quantidade");
//    for( var i = 1; i <= estoque; i++ ){
//       quantidade.options[i].text = i;  // adicionar novo registro		
//       quantidade.options[i].value = i; // dar o valor ao registro
//    }
//    //alert(estoque);
    
    var x = document.getElementById("quantidade");
    x.innerHTML = "";
    x.innerHTML = "<option value=''>Selecione</option>";
    for( var i = 1; i <= estoque; i++ ){
        var option = document.createElement("option");
        option.text = i;
        x.add(option, x[i-1]);
        
        //if( i == estoque ){
        //    option.value = '';
        //    option.text = 'Selecione a quantidade';
        //    x.add(option, x[i]);
        //}
    }
    //if( isNaN( estoque ) ){
    //    x.innerHTML = "<option value=''>Selecione o produto</option>";
    //}//else{
    //    x.innerHTML = "<option value=''>Selecione a quantidade</option>";
    //}
    
}


function obterQuantidade2(){
    var produto = $("#sel1 option:selected").text();
    var pos = produto.lastIndexOf("-");
    var estoque = produto.substring( pos+2 );
    var x = $('#quantidade');
    x.empty();
    if( estoque == 0 ){
        x.append("<option value='0'>Não há estoque do produto</option>");
    }else{
        x.append("<option value=''>Selecione a quantidade</option>");
        for( var i = 1; i <= estoque; i++ ){
            //var option = document.createElement("option");
            //option.text = i;
            //x.add(option, x[i-1]);
            x.append("<option value="+i+">"+i+"</option>");

        }
    }
//    var produto = document.getElementById("sel1").options[document.getElementById("sel1").selectedIndex].text;
//   
//    var pos = produto.lastIndexOf("-");
//    var estoque = produto.substring( pos+2 );
//   
//    var x = document.getElementById("quantidade");
//    x.innerHTML = "";
//    x.innerHTML = "<option value=''>Selecione</option>";
//    for( var i = 1; i <= estoque; i++ ){
//        var option = document.createElement("option");
//        option.text = i;
//        x.add(option, x[i-1]);
//        
//    }
//    
}
*/