<?php
class Conexao {
    
    private $con,$servidor='localhost',$usuario='root',$senha='',$bd='ControleEstoque';

    public function conectar(){
        try{
            $conexao = new PDO("mysql:host=$this->servidor;dbname=$this->bd", $this->usuario, $this->senha );
            return $conexao;
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        
    }

}
?>
