<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> Vendas </h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table id="vendas" class="table table-bordered table-hover">

                    <thead>
                      <tr>
                        <th> Cliente </th>
                        <th> Funcionário </th>
                        <th> Valor total </th>
                        <th> Data </th>
                        <th> Deletar </th>
                        <th> Alterar </th>
                        <th> Recibo </th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                        foreach ($vendas as $venda){
                            $idVenda = $venda['id_venda'];
                            $valor = $valor = str_replace( ".", ",",$venda['valor'] );
                            $dataHora = $formataData->formataDataHoraBrasileira( $venda['data_hora'] );
                            $nomeCliente = $venda['nome_cliente'];
                            $nomeFuncionario = $venda['nome_funcionario'];
                            //echo utf8_decode( $cliente['nome'] );
                            //echo utf8_decode( $cliente['email'] );
                            //print_r($cliente); die;
                    ?>        
                            <tr>
                              <td> <?php echo utf8_encode( $nomeCliente ); ?> </td>
                              <td> <?php echo utf8_encode( $nomeFuncionario ); ?> </td>
                              <td> <?php echo $valor ?> </td>
                              <td> <?php echo $dataHora; ?> </td>
                              <td> <a alt="deletar_venda" href="deletar_venda.php?id_venda=<?php echo $idVenda;  ?>"> Deletar </a> </td>
                              <td> <a alt="altera_venda" href="altera_venda.php?id_venda=<?php echo $idVenda ?>"> Alterar </a> </td>
                              <td> <a alt="emitir_recibo" href="emitir_recibo_pdf.php?periodo=01/01/2015-31/08/2015&id_venda=<?php echo $idVenda ?>"> Emitir recibo </a> </td>
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

