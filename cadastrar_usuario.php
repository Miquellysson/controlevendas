<?php
include_once 'class/dao/UsuarioDAO.class.php';
session_start();

$login = $_POST['login'];
$senha = $_POST['senha'];
$repitaSenha = $_POST['repita_senha'];

//print_r($_POST);
//die;
try{
    if( $senha != $repitaSenha ){
        $_SESSION['msg'] = 'Erro: Senhas não conferem!';
        header("Location:cadastro_usuario.php");
    }else if( !preg_match("/^[._a-zA-Z]+$/",$login) ){
        $_SESSION['msg'] = 'Erro: Login permite apenas letras, . e _!';
        header("Location:cadastro_usuario.php");
    }else{
    
        $usuarioDAO = new UsuarioDAO();
        //var_dump( $usuarioDAO->existeUsuario($login) ); 

        if( !$usuarioDAO->existeUsuario($login) ){

            $usuario = new Usuario($login, $senha);

            $cadastrarUsuario = $usuarioDAO->cadastrarUsuario($usuario);

            if ($cadastrarUsuario === true){
                $_SESSION['msg'] = 'Usuário cadastrado com sucesso!';
            }else{
                $_SESSION['msg'] = 'Erro na tentativa de cadastrar usuário!';
            }
            header("Location:index.php");
        }else{
            $_SESSION['msg'] = 'Erro: Usuário já existe!';
            header("Location:cadastro_usuario.php");
        }
    }
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>
