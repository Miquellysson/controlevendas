<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/model/Usuario.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/controlevendas/';
//include_once $caminho_base.'class/model/Usuario.class.php';
session_start();
if( !isset( $_SESSION['logado'] ) ){
    header("Location:../../index.php");
}

include_once($caminho_base . "/class/dao/ClienteDAO.class.php");
include_once($caminho_base . "/class/dao/FuncionarioDAO.class.php");
include_once($caminho_base . "/class/dao/ProdutoDAO.class.php");
//include_once $caminho_base.'class/dao/ClienteDAO.class.php';
//include_once $caminho_base.'class/dao/FuncionarioDAO.class.php';
//include_once $caminho_base.'class/dao/ProdutoDAO.class.php';

$clienteDAO = new ClienteDAO();
$funcionarioDAO = new FuncionarioDAO();
$produtoDAO = new ProdutoDAO();

$clientes = $clienteDAO->getAllClientes(); //Array de objetos clientes
$funcionarios = $funcionarioDAO->getAllFuncionarios(); //Array de objetos funcionários
$produtos = $produtoDAO->getAllProdutos();
//print_r($produtos); die;
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title> Cadastro venda </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link href="../../dist/css/estilo.css" rel="stylesheet" type="text/css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="../../https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="../../https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <style>
        .row{
            margin-bottom: 3%;
        }
        
        .quantidade{
            margin-top: -8%;
        }
        
        
        .botoes{
            margin-top: 6%;
        }
    </style>   
        
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">
      
      <?php 
      include_once '../include/menu.php';
      ?>
      
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container-fluid">
          
          <!-- Main content -->
          <section class="content">
            
            <div class="row">
                <!-- left column -->
                <div class="col-md-6 col-md-offset-3">
                    
                  <?php include_once '../../mensagem.php'; ?>
                    
                  <!-- general form elements -->
                  <div class="box box-primary">
                     
                    <div class="box-header">
                      <h3 class="box-title"> Cadastro de vendas </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="cadastro_venda" name="cadastro_venda" action="cadastrar_venda.php" method="post">
                      <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                
                                <label> Cliente </label>
                                <select class="form-control" name="cliente" >
                                  <option value=""> Selecione o cliente </option>
                                  <?php
                                  foreach ( $clientes as $cliente ){
                                  ?>
                                    <option value="<?php echo $cliente->getIdCliente(); ?>"> <?php echo $cliente->getNome(); ?> </option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              
                            </div>

                            <div class="col-md-6">
                                
                                <label> Funcionário </label>
                                <select class="form-control" name="funcionario" >
                                  <option value=""> Selecione o funcionário </option>
                                  <?php
                                  foreach ( $funcionarios as $funcionario ){
                                  ?>
                                    <option value="<?php echo $funcionario->getIdFuncionario(); ?>"> <?php echo $funcionario->getNome(); ?> </option>
                                  <?php
                                  }
                                  ?>
                                </select>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                
                                <label>Produto</label>
                                <select class="form-control" id="produto" name="produto">
                                  <option value=""> Selecione o produto </option>
                                 
                                  <?php
                                  foreach ( $produtos as $produto ){
                                  ?>
                                    <option value="<?php echo $produto->getIdProduto().';'.$produto->getPrecoVenda(); ?>"> <?php echo $produto->getDescricao().' - '.$produto->getPrecoVenda().' - '.$produto->getQuantidade(); ?> </option>
                                  <?php
                                  }
                                  ?>
                                  
                                </select>
     
                            </div>

                            <div class="col-md-1 botoes">
                                <button id="adicionar" > > </button>
                                <button id="remover" > < </button>
                            </div>    
                            
                            <div class="col-md-6">
                                <label>Produtos</label>
                                <select multiple class="form-control" id="produtos" name="produtos[]" >
                                </select>
                            </div>
                            
                            <div class="col-md-5 quantidade">
                                <label>Quantidade</label>
                                <select class="form-control" id="quantidade" name="quantidade" >
                                  <option value=""> Selecione o produto </option>
                                </select>
                                
                                
                            </div>
                            
                        </div><!-- /.row -->
                        
                        <!--
                        <div class="row">
                            
                            <div class="col-md-4">
                                
                                <label>Produto</label>
                                <select class="form-control" id="sel1" onchange="return obterQuantidade2();">
                                  <option value=""> Selecione o produto </option>
                                  <?php
                                  foreach ( $produtos as $produto ){
                                  ?>
                                    <option value="<?php echo $produto->getIdProduto().';'.$produto->getPrecoVenda(); ?>"> <?php echo $produto->getDescricao().' - '.$produto->getPrecoVenda().' - '.$produto->getQuantidade(); ?> </option>
                                  <?php
                                  }
                                  ?>
                                </select>
                            </div>
                            
                            <div class="col-md-5">
                                
                                <label>Produtos</label>
                                <select multiple class="form-control" id="sel2">
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <button class="btn btn-primary" id="trocar"> Trocar </button>
                            
                            
                            
                                <button class="btn btn-primary" id="voltar"> Voltar </button>
                            </div>
                            
                        </div>    
                        -->          
                      </div><!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary"> Cadastrar </button>
                        <button type="reset" class="btn btn-primary"> Limpar </button>
                      </div>

                    </form>
                  </div><!-- /.box --> 
                </div>
            </div>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      
      <?php 
      include_once '../include/rodape.php';
      ?>
      
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    
    <script src="../../dist/js/cadastro_venda.js" type="text/javascript"></script>
    
    <!-- Page script -->
    <script type="text/javascript">
    	/*$(function () {
	        $("[data-mask]").inputmask();
    	 });
         
         function adicionar(){
            var produto = document.getElementById("produto"); 
            var quantidade = document.getElementById("quantidade");	
            var produtos = document.getElementById("produtos");	
          
            if ( quantidade.selectedIndex != -1 ){		
                tam = produtos.options.length++;	 // qtd registros do select		
                produtos.options[tam].text = produto.options[document.getElementById("produto").selectedIndex].text+'-'+quantidade.value;  // adicionar novo registro		
                produtos.options[tam].value = produto.value+'-'+quantidade.value; // dar o valor ao registro		
                produtos.options[tam].selected = 1; 
                //select2.options[tam].text=select1.value;  // adicionar novo registro		
                //select2.options[tam].value=select1.value; // dar o valor ao registro		
                //select2.options[tam].selected=0; // 0 para não selecionada, 1 para selecionada		
                //select1.options[select1.selectedIndex] = null;
                //return false;
            }
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
            //alert(tam);
            //if ( quantidade.selectedIndex != -1 ){		
            for( var i = 0 ; i< tam; i++ ){
                //alert( i );
                //tam = produtos.options.length++;	 // qtd registros do select		
                //produtos.options[i].text = produto.options[document.getElementById("produto").selectedIndex].text+'-'+quantidade.value;  // adicionar novo registro		
                //produtos.options[tam].value = produto.value; // dar o valor ao registro		
                produtos.options[i].selected = 1; 
            }
            
         }*/
    
         /*
         function limpar(){
            var produtos = document.getElementById("produtos");	
            var tam = produtos.options.length;
            
            var select = document.getElementById('produtos');
            value = select.selectedIndex;
            var i = 0;
            while( i < tam ){
                select.removeChild( select[value] );
                i++;
            }
            //document.getElementById("produto").value = 1;
            //document.getElementById("quantidade").value = 1;
            //document.getElementById("cliente").value = "";
            //document.getElementById("funcionario").value = "";
            return false;
         }
         */
     </script>
  </body>
</html>
