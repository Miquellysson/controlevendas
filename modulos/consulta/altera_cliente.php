<?php
$caminho_base = $_SERVER['DOCUMENT_ROOT'];
include_once($caminho_base . "/class/model/Usuario.class.php");
//$caminho_base = $_SERVER['DOCUMENT_ROOT'].'/ControleVendas/';
//include_once $caminho_base.'class/model/Usuario.class.php';

session_start();
if( !isset( $_SESSION['logado'] ) ){
    header("Location:../../index.php");
}
include_once($caminho_base . "/class/dao/ClienteDAO.class.php");
//include_once $caminho_base.'class/dao/ClienteDAO.class.php';

$idCliente = $_GET['id_cliente'];
$clienteDAO = new ClienteDAO();
$cliente = $clienteDAO->buscaClientePorId($idCliente);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title> Alterar cliente </title>
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
                      <h3 class="box-title"> Alterar cliente </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="cadastro_cliente" name="altera_cliente" action="alterar_cliente.php" method="post">
                      <div class="box-body">
                        
                        <input type="hidden" class="form-control" name="id_cliente" value="<?php echo $cliente[0]['id_cliente']; ?>">
                        <input type="hidden" class="form-control" name="id_telefone" value="<?php echo $cliente[0]['id_telefone_fk']; ?>">
                        <input type="hidden" class="form-control" name="id_endereco" value="<?php echo $cliente[0]['id_endereco_fk']; ?>">
                          
                        <div class="row">
                            <div class="col-xs-6">
                                <label for="nome" class="obrigatorio"> Nome </label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo utf8_encode($cliente[0]['nome']); ?>">
                            </div>

                            <div class="col-xs-6">
                                <label for="email"> E-mail </label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $cliente[0]['email']; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <label for="telefone_residencial"> Telefone residencial </label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                  </div>
                                  <input type="text" id="telefone_residencial" name="telefone_residencial" class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask value="<?php echo $cliente[0]['telefone_residencial']; ?>" />
                                </div><!-- /.input group -->
                            </div>

                            <div class="col-xs-6">
                                <label for="telefone_celular" class="obrigatorio"> Telefone celular </label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                  </div>
                                  <input type="text" id="telefone_celular" name="telefone_celular" class="form-control" data-inputmask='"mask": "(99) 99999-9999"' data-mask value="<?php echo $cliente[0]['telefone_celular']; ?>" />
                                </div><!-- /.input group -->
                            </div>
                        </div><!-- /.form group -->

                        <div class="row">
                            <div class="col-xs-8">
                                <label for="logradouro"> Logradouro </label>
                                <input type="text" class="form-control" name="logradouro" value="<?php echo utf8_encode($cliente[0]['logradouro']); ?>" >
                            </div>

                            <div class="col-xs-4">
                                <label for="numero"> Número </label>
                                <input type="text" class="form-control" name="numero" value="<?php echo $cliente[0]['numero']; ?>" >
                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="col-xs-6">
                                <label for="bairro"> Bairro </label>
                                <input type="text" class="form-control" name="bairro" value="<?php echo utf8_encode($cliente[0]['bairro']); ?>">
                            </div>
                            
                            <div class="col-xs-6">
                                <label for="complemento"> Complemento </label>
                                <input type="text" class="form-control" name="complemento" value="<?php echo utf8_encode($cliente[0]['complemento']); ?>">
                            </div>
                                
                        </div>
                        
                        
                      </div><!-- /.box-body -->

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary"> Alterar </button>
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
    
    <!-- InputMask -->
    <script src="../../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    
    <script src="../../dist/js/cadastro_cliente.js" type="text/javascript"></script>
    
  </body>
</html>