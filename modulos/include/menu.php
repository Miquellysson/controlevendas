<?php 
//$base_url = $_SERVER['SERVER_NAME'].'/ControleVendas/modulos/';
$base_url = $_SERVER['SERVER_NAME'].'/modulos/';
?>
      
      <header class="main-header">               
        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
          <div class="navbar-header">
            <!-- <a href="../../index2.html" class="navbar-brand"><b>Admin</b>LTE</a>  -->
            
            <!-- <img src="../../imagens/icons.png" /> -->
            
            <img src="../../dist/img/logo.png" width="90px" height="60px" />
            
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
            
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
              
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Cadastro <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="../cadastro/cadastro_cliente.php"> Cliente </a></li>
                  <li><a href="../cadastro/cadastro_funcionario.php"> Funcionário </a></li>
                  <li><a href="../cadastro/cadastro_produto.php"> Produto </a></li> 
                </ul>
              </li>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Consulta <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="../consulta/consulta_cliente.php"> Cliente </a></li>
                  <li><a href="../consulta/consulta_funcionario.php"> Funcionário </a></li>
                  <li><a href="../consulta/consulta_produto.php"> Produto </a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Compra <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="../compra/cadastro_compra.php"> Cadastrar compra </a></li>
                  <li><a href="../compra/consulta_compra.php"> Consultar compra </a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Venda <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="../venda/cadastro_venda.php"> Cadastrar venda </a></li>
                  <li><a href="../venda/consulta_venda.php"> Consultar venda </a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Relatório <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="../relatorio/relatorio_venda_periodo.php"> Vendas do período </a></li>
                  <li><a href="../relatorio/relatorio_despesas_receitas.php"> Despesas/Lucros </a></li> 
                </ul>
              </li>
            
            </ul> 
             
            <ul class="nav navbar-nav navbar-right">
              <li><a href="../../logout.php"> Sair </a></li>
            </ul>  
              
          </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>

