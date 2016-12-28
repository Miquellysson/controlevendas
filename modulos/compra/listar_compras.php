<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> Compras </h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table id="vendas" class="table table-bordered table-hover">

                    <thead>
                      <tr>
                        <th> Valor total </th>
                        <th> Data </th>
                        <th> Deletar </th>
                        <th> Alterar </th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                        foreach ($compras as $compra){
                            $idCompra = $compra['id_compra'];
                            $valor = str_replace( ".", ",", $compra['valor'] );
                            $dataHora = $formataData->formataDataHoraBrasileira( $compra['data_hora'] );
                    ?>        
                            <tr>
                              <td> <?php echo $valor ?> </td>
                              <td> <?php echo $dataHora; ?> </td>
                              <td> <a alt="deletar_compra" href="deletar_compra.php?id_compra=<?php echo $idCompra;  ?>"> Deletar </a> </td>
                              <td> <a alt="alterar_compra" href="altera_compra.php?id_compra=<?php echo $idCompra ?>"> Alterar </a> </td>
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

