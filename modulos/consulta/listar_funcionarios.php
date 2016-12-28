<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> Funcionários </h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table id="funcionarios" class="table table-bordered table-hover">

                    <thead>
                      <tr>
                        <th> Nome </th>
                        <th> e-mail </th>
                        <th> Salário </th>
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
                        foreach ($funcionarios as $funcionario){
                            $idFuncionario = $funcionario['id_funcionario'];
                            $idTelefone = $funcionario['id_telefone_fk'];
                            $idEndereco = $funcionario['id_endereco_fk'];
                            //echo utf8_decode( $cliente['nome'] );
                            //echo utf8_decode( $cliente['email'] );
                            //print_r($cliente); die;
                    ?>        
                            <tr>
                              <td> <?php echo utf8_encode( $funcionario['nome'] ); ?> </td>
                              <td> <?php echo $funcionario['email']; ?> </td>
                              <td> <?php echo str_replace( '.',  ',', $funcionario['salario'] ); ?> </td>
                              <td> <?php echo $funcionario['telefone_residencial']; ?> </td>
                              <td> <?php echo $funcionario['telefone_celular']; ?> </td>
                              <td> <?php echo utf8_encode( $funcionario['logradouro'] ); ?> </td>
                              <td> <?php echo $funcionario['numero']; ?> </td>
                              <td> <?php echo utf8_encode( $funcionario['bairro'] ); ?> </td>
                              <td> <?php echo utf8_encode( $funcionario['complemento'] ); ?> </td>
                              <!--<td> <?php echo $funcionario['estado']; ?> </td>
                              <td> <?php echo $funcionario['cidade']; ?> </td>-->
                              <td> <a alt="deletar_funcionario" href="deletar_funcionario.php?<?php echo 'id_funcionario='.$idFuncionario.'&id_telefone='.$idTelefone.'&id_endereco='.$idEndereco;  ?>"> Deletar </a> </td>
                              <td> <a alt="altera_funcionario" href="altera_funcionario.php?id_funcionario=<?php echo $idFuncionario ?>"> Alterar </a> </td>
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