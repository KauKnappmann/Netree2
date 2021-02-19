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

$html = file_get_contents("prodInfo.html");


if($cod[1] !=null){

    $html = str_replace('{{tabela}}',"<p>".$cod[0]."</p>",$html);

    $html = str_replace('{{nome}}',$toProd[$cod[1]]['nome'],$html);

    $html = str_replace('{{img}}',"<img style='width:285px;height: 285px;' src='../Upload/".$cod[0]."/".$toProd[$cod[1]]['img']."'>",$html);
    
    $html = str_replace('{{valor}}',$toProd[$cod[1]]['valor'],$html);
    
    $html = str_replace('{{local}}',$toProd[$cod[1]]['nome'],$html);
    
    $html = str_replace('{{tipo}}',$toProd[$cod[1]]['tipo'],$html);
    }else{
    $html = str_replace('{{nome}}',"error",$html);
    
    $html = str_replace('{{img}}',"error",$html);
    
    $html = str_replace('{{valor}}',"error",$html);
    
    $html = str_replace('{{local}}',"error",$html);
    
    $html = str_replace('{{tipo}}',"error",$html);
}

echo $html;
?>