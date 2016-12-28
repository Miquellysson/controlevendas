<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> Clientes </h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table id="clientes" class="table table-bordered table-hover">

                    <thead>
                      <tr>
                        <th> Nome </th>
                        <th> e-mail </th>
                        <th> Telefone residencial </th>
                        <th> Telefone celular </th>
                        <th> Logradouro </th>
                        <th> Número </th>
                        <th> Bairro </th>
                        <th> Complemento </th>
                        <th> Deletar </th>
                        <th> Alterar </th>
                        <!--<th> Estado </th>
                        <th> Cidade </th>-->
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                        foreach ($clientes as $cliente){
                            $idCliente = $cliente['id_cliente'];
                            $idTelefone = $cliente['id_telefone_fk'];
                            $idEndereco = $cliente['id_endereco_fk'];
                            //echo utf8_decode( $cliente['nome'] );
                            //echo utf8_decode( $cliente['email'] );
                            //print_r($cliente); die;
                    ?>        
                            <tr>
                              <td> <?php echo utf8_encode( $cliente['nome'] ); ?> </td>
                              <td> <?php echo $cliente['email']; ?> </td>
                              <td> <?php echo $cliente['telefone_residencial']; ?> </td>
                              <td> <?php echo $cliente['telefone_celular']; ?> </td>
                              <td> <?php echo utf8_encode( $cliente['logradouro'] ); ?> </td>
                              <td> <?php echo $cliente['numero']; ?> </td>
                              <td> <?php echo utf8_encode( $cliente['bairro'] ); ?> </td>
                              <td> <?php echo utf8_encode( $cliente['complemento'] ); ?> </td>
                              <!--<td> <?php echo $cliente['estado']; ?> </td>
                              <td> <?php echo $cliente['cidade']; ?> </td>-->
                              <td> <a alt="deletar_cliente" href="deletar_cliente.php?<?php echo 'id_cliente='.$idCliente.'&id_telefone='.$idTelefone.'&id_endereco='.$idEndereco;  ?>"> Deletar </a> </td>
                              <td> <a alt="altera_cliente" href="altera_cliente.php?id_cliente=<?php echo $idCliente ?>"> Alterar </a> </td>
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