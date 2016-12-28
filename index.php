<?php
session_start();

//print_r($_SESSION);
if( isset( $_SESSION['logado'] ) ){
    header("Location:modulos/cadastro/cadastro_cliente.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title> Controle Vendas </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <link href="dist/css/login.css" rel="stylesheet" type="text/css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body class="login-page">
    <?php include_once 'mensagem.php'; ?>  
    <div class="login-box">
      <div class="login-logo">
        <h1> Controle Vendas </h1>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Favor autentitique-se para iniciar a sessão</p>
        <form action="autenticar.php" method="post">
          <div class="form-group has-feedback">
              <input type="text" class="form-control" name="login" placeholder="Login"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" class="form-control" name="senha" placeholder="Senha"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat"> Autenticar </button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="cadastro_usuario.php"> Cadastrar um novo usuário </a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   
  </body>
</html>