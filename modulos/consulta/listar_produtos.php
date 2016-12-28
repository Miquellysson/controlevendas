<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> Produtos </h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table id="produtos" class="table table-bordered table-hover">

                    <thead>
                      <tr>
                        <th> Descrição </th>
                        <th> Preço de compra </th>
                        <th> Preço de venda </th>
                        <th> Quantidade </th>
                        <th> Deletar </th>
                        <th> Alterar </th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                        foreach ($produtos as $produto){
                            $idProduto = $produto['id_produto']; 
                    ?>        
                            <tr>
                              <td> <?php echo utf8_encode( $produto['descricao'] ); ?> </td>
                              <td> <?php echo str_replace('.', ',', $produto['preco_compra'] ); ?> </td>
                              <td> <?php echo str_replace('.', ',', $produto['preco_venda'] ); ?> </td>
                              <td> <?php echo $produto['quantidade']; ?> </td>
                              <td> <a alt="deletar_produto" href="deletar_produto.php?id_produto=<?php echo $idProduto;  ?>"> Deletar </a> </td>
                              <td> <a alt="altera_produto" href="altera_produto.php?id_produto=<?php echo $idProduto ?>"> Alterar </a> </td>
                            </tr>
                    <?php
                        }
                    ?>        
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>