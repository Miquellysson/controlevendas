<?php
$caminho_base = $_SERVER["DOCUMENT_ROOT"];
//include_once 'class/dao/UsuarioDAO.class.php';
include_once($caminho_base . "/class/dao/UsuarioDAO.class.php");
session_start();
$login = $_POST['login'];
$senha = sha1( $_POST['senha'] );

//print_r($_POST);
//die;
try{
    if( !preg_match("/^[._a-zA-Z]+$/",$login) ){
        
        $_SESSION['msg'] = 'Erro: Login permite apenas letras, . e _!';
        header("Location:index.php");
    }else{
        
        $usuarioDAO = new UsuarioDAO();
//print_r($usuarioDAO); die;
        //var_dump( $usuarioDAO->existeUsuario($login) ); 
        $usuario = $usuarioDAO->autenticar($login, $senha);
        //print_r($usuario);
        //die;
        if( isset($usuario) ){

            $_SESSION['logado'] = $usuario;
            /*if ($cadastrarUsuario === true){
                $_SESSION['msg'] = 'Usuário cadastrado com sucesso!';
            }else{
                $_SESSION['msg'] = 'Erro na tentativa de cadastrar usuário!';
            }*/
            header("Location:modulos/cadastro/cadastro_cliente.php");
        }else{
            $_SESSION['msg'] = 'Erro: Login ou senha incorretos!';
            header("Location:index.php");
        }
    }
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>
