<?php

try{
    include_once "../conf/Conexao.php";
    
    require "../classes/adm.php";
    
    $pdo = Conexao::getInstance();
    $adm = new Adm($pdo);
    }catch(Exception $e){
        echo $e->getCode();
    }

$cod = isset($_GET['cod']) ? $_GET['cod'] : null;

$cod = explode("&",$cod);

$toProd = $adm->view($cod[0]);
$posi = $cod[1];
$id = $cod[2];
$html = file_get_contents("prodInfo.html");


if($posi !=null){

    $html = str_replace('{{tabela}}',$cod[0],$html);

    $html = str_replace('{{nome}}',$toProd[$posi]['nome'],$html);

    $html = str_replace('{{img}}',$cod[0]."/".$toProd[$posi]['img'],$html);
    
    $html = str_replace('{{valor}}',$toProd[$posi]['valor'],$html);
    
    $html = str_replace('{{local}}',$toProd[$posi]['nome'],$html);
    
    $html = str_replace('{{tipo}}',$toProd[$posi]['tipo'],$html);
  
    $html = str_replace('{{id}}',$toProd[$posi]['cod']-1,$html);
    }else{
    $html = str_replace('{{nome}}',"error",$html);
    
    $html = str_replace('{{img}}',"error",$html);
    
    $html = str_replace('{{valor}}',"error",$html);
    
    $html = str_replace('{{local}}',"error",$html);
    
    $html = str_replace('{{tipo}}',"error",$html);
}

echo $html;
?>