<?php
class FormataData {
    
    function formataDataAmericana($dataBrasileira){
        return substr($dataBrasileira, -4).'-'.substr($dataBrasileira, 3,2).'-'.substr($dataBrasileira, 0,2);
    }
    
    function formataDataBrasileira($dataAmericana){
        return substr($dataAmericana, -2).'/'.substr($dataAmericana, 5,2).'/'.substr($dataAmericana, 0,4);
    }
    
    function formataDataBancoInicio($dataBrasileira){
        return substr($dataBrasileira, -4).'-'.substr($dataBrasileira, 3,2).'-'.substr($dataBrasileira, 0,2).' 00:00:00';
    }
    
    function formataDataBancoFim($dataBrasileira){
        return substr($dataBrasileira, -4).'-'.substr($dataBrasileira, 3,2).'-'.substr($dataBrasileira, 0,2).' 23:59:59';
    }
    
    function formataDataHoraBrasileira($dataAmericana){
        return substr($dataAmericana, 8,2).'/'.substr($dataAmericana, 5,2).'/'.substr($dataAmericana, 0,4).' '.substr($dataAmericana, 11);
    }

    function mesPorExtenso($mes){
        $mes_extenso = array(
            'Jan' => 'janeiro',
            'Feb' => 'fevereiro',
            'Mar' => 'marco',
            'Apr' => 'abril',
            'May' => 'maio',
            'Jun' => 'junho',
            'Jul' => 'julho',
            'Aug' => 'agosto',
            'Sep' => 'setembro',
            'Oct' => 'outubro',
            'Nov' => 'novembro',
            'Dec' => 'dezembro'
        );
        return $mes_extenso["$mes"];
    }
    
}
