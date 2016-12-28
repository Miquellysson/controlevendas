<?php
/**
 * Description of TrataTelefone
 *
 * @author roberto
 */
class TrataTelefone {
    
    public function apenasNumeros($telefone){
        $telefone = str_replace('-', '', $telefone);
        $telefone = str_replace('(', '', $telefone);
        $telefone = str_replace(')', '', $telefone);
        $telefone = str_replace('_', '', $telefone);
        $telefone = str_replace(' ', '', $telefone);
        return $telefone;
    }
    
}
