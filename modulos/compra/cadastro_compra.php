<?php
include_once("../../class/model/Usuario.class.php");
session_start();
if( !isset( $_SESSION['logado'] ) ){
    header("Location:../../index.php");
}
include_once("../../class/dao/ProdutoDAO.class.php");

$produtoDAO = new ProdutoDAO();

$produtos = $produtoDAO->getAllProdutos();
//print_r($produtos); die;
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title> Cadastro compra </title>
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
                      <h3 class="box-title"> Cadastro de compras </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="cadastro_compra" name="cadastro_compra" action="cadastrar_compra.php" method="post">
                      <div class="box-body">

                        <div class="row">
                            <div class="col-md-5">
                                
                                <label>Produto</label>
                                <select class="form-control" id="produto" name="produto">
                                  <option value=""> Selecione o produto </option>
                                 
                                  <?php
                                  foreach ( $produtos as $produto ){
                                  ?>
                                    <option value="<?php echo $produto->getIdProduto().';'.$produto->getPrecoCompra(); ?>"> <?php echo $produto->getDescricao().' - '.$produto->getPrecoCompra(); ?> </option>
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
                                <input class="form-control" type="text" id="quantidade" name="quantidade">                               
                            </div>
                            
                        </div><!-- /.row -->
                                  
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
    
    <script src="../../dist/js/cadastro_compra.js" type="text/javascript"></script>
    
  </body>
</html>
