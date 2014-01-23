<?php

function validaPessoa($nome, $cpf, $nascimento, $sexo, $estado, $telefone, $observacoes){

    $camposValidados = true;
    //inicializaçao
    require_once("menu.php");

    
    if(!isset($_SESSION["cadastros"])){
        $_SESSION["cadastros"] = array();
    }

    setlocale(LC_ALL, "pt_BR", "ptb");
        
    
    $nascimento = $_REQUEST["nascimento"];
    $aceito = false;
    if(isset($_REQUEST["aceito"])){
        $aceito = true;
    }
    
    //validaçao
    $camposValidados = true;
    $nome = trim($nome);    
    if(empty($nome)){
        echo "Por favor, preencha o campo nome <br/>";
        $camposValidados = false;
    }
    if (!preg_match( "/^[a-zA-ZãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇ\s]+$/", $nome)){
        echo "Formato de nome inválido <br/>";
        $camposValidados = false;
    }
    
    
    $cpf = trim($cpf);
    if(empty($cpf)){
        echo "Por favor, preencha o CPF <br/>";
        $camposValidados = false;
    }
    
    $telefone = trim($telefone);
    if(empty($telefone)){
        echo "Por favor, preencha o telefone <br/>";
        $camposValidados = false;
    }
    
    
    $observacoes = trim($observacoes);
    if(empty($observacoes)){
        echo "O campo observações é obrigatório <br/>";
        $camposValidados = false;
    }
    
    
    if($estado == -1){
        echo "Por favor, selecione uma opção de estado <br/>";
        $camposValidados = false;
    }
  
    if (!preg_match("/^(\d{3}\s)?\d{4}-\d{4}$/", $telefone)){
        echo "Formato de telefone inválido <br/>";
        $camposValidados = false;
    }
    if (!preg_match("/^[a-zA-ZãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇ\s\\.\\,]+$/", $observacoes)){
        echo "Formato de observações
        inválido <br/>";
        $camposValidados = false;
    }
    if (!preg_match("/^\d{3}\\.\d{3}\\.\d{3}\\-\d{2}$/", $cpf)){
        echo "Formato inválido para o campo cpf <br/>";
        $camposValidados = false;
    }
    //NASCIMENTO
    $nascimento = trim($nascimento);
    if(empty($nascimento)){
        echo "Por Favor,preencha o campo <b>NASCIMENTO</b> <br/>";
        $formValido = false;
    }
    else if(!preg_match("/^\d{2}\\/\d{2}\\/\d{4}$/",$nascimento)){
        echo "Formato invalido do <b>NASCIMENTO</b> Utilize o formato dd/mm/aaaa <br/>";
        $camposValidados = false;
    }
    else{
        $pedacos = explode('/',$nascimento);
        $dia = $pedacos[0];
        $mes = $pedacos[1];
        $ano = $pedacos[2];
        
        if(!checkdate($mes, $dia, $ano)){
            echo "<b>data invalida<b>";
            $camposValidados = false;                           
        }
       
        else{
            $nascimentoYmd = $ano.$mes.$dia;
            $dataAtual = date('Ymd');
        }
        if($dataAtual < $nascimentoYmd){
            echo "Data de Nascimento no Futuro!<br>" ;
            $camposValidados = false;  
            
        }
       
    }
    
    if (!preg_match("/^\d{2}.\d{2}.\d{4}$/", $nascimento)){
        echo "Data de Nascimento Inválido <br/>";
        $camposValidados = false;
    }
    
    
    
    $sexo = null;
        if(isset($_REQUEST["sexo"])){
        $sexo = $_REQUEST["sexo"];
    }
    else{
        echo "Selecione uma opção de sexo <br/>";
        $camposValidados = false;
    }
    
    return $camposValidados;
}



?>
