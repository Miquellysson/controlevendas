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
//include_once $caminho_base.'class/dao/ClienteDAO.class.php';
//include_once $caminho_base.'class/dao/FuncionarioDAO.class.php';
$clienteDAO = new ClienteDAO();
$funcionarioDAO = new FuncionarioDAO();
$clientes = $clienteDAO->getAllClientes(); //Array de objetos clientes
$funcionarios = $funcionarioDAO->getAllFuncionarios(); //Array de objetos funcionários
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title> Vendas período </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <link href="../../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
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
                    
                  <?php //include_once '../../mensagem.php'; ?>
                    
                  <!-- general form elements -->
                  <div class="box box-primary">
                     
                    <div class="box-header">
                      <h3 class="box-title"> Relatório de vendas </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="relatorio_venda" name="venda_periodo" action="venda_periodo_pdf.php" method="post">
                      <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                
                                <label> Cliente </label>
                                <select class="form-control" id="cliente" name="cliente" >
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
                                <select class="form-control" id="funcionario" name="funcionario" >
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
                            
                            <div class="col-md-12">
                                <!-- Date range -->
                                <div class="form-group">
                                  <label>Período:</label>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="periodo" name="periodo" />
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                            </div>        
                            
                        </div>

                      </div><!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary"> Gerar PDF </button>
                        <button type="reset" class="btn btn-primary"> Limpar </button>
                      </div>

                    </form>         
                    
                  </div><!-- /.box --> 
                </div>
            </div> <!-- row -->
            
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
    
    <!-- date-range-picker -->
    <script src="../../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    
    <script src="../../dist/js/relatorio_venda_periodo.js" type="text/javascript"></script>
    	
  </body>
</html>
