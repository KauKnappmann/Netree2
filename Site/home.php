<link rel="icon" href="css/images/logoVerde.png" type="image/x-icon" />
<?php
        try{
include_once "conf/Conexao.php";

require "classes/adm.php";

$pdo = Conexao::getInstance();
$adm = new Adm($pdo);
}catch(Exception $e){
    echo $e->getCode();
}


$html = file_get_contents("home.html");

$link['produto'] = "produto/produto.php";

$logout = isset($_POST['logout']) ? $_POST['logout'] : false;


if($logout){
    $logout= false;
    $html = str_replace('{{deslogado}}',"deslogado",$html);
    $_SESSION['login'] = 0;  
}


if(!isset($_SESSION))
    session_start();   

 $_SESSION['login'] = isset($_SESSION['login']) ? $_SESSION['login'] : 0;

if (!isset($_GET['erro'])){
    if(isset($_SESSION['login']))
        if($_SESSION['login'] != 0){
            
            $html = str_replace('{{nome}}',"<center>BEM VINDO ".strtoupper($_SESSION['nome'])."</center>",$html);
     
        //  echo "Bem vindo usuario ".$_SESSION['nome'];
        //  echo "<img class='fotoIcon' src='Upload/Plantas".$_SESSION['perfilPicture']."'>";
         
        $html = str_replace('{{deslogar}}','<form method="POST"><button type="submit"  value="true" name="logout">deslogar</button></form>',$html);  
          
          
         $viewAdm = $adm->view("administrador");
            
        foreach($viewAdm as $i){

            if($_SESSION['login'] == $i['codUsuario'])
             $html = str_replace('{{adm}}',
             '<li class="has-children "><a href="usuario/adm.html" title="Administrar">Administrar</a>
             <ul class="dropdown">
             <li  class="has-children"><a href="#" title="Visualizar">Visualizar</a>
             <ul class="dropdown">
             <li><a href="usuario/usuarios.php" title="Usuários">Usuários</a></li>
             <li><a href="produto/registros.php?table=plantas " title="Plantas">Plantas</a></li>
             <li><a href=produto/registros.php?table=produtos " title="Produtos">Produtos</a></li>
             </ul></li>
             <li class="has-children"><a href="#" title="Cadastros">Cadastros</a>
             <ul class="dropdown">
             <li><a href="produto/cadastroPlanta.html" title="Plantas">Plantas</a></li>
             <li><a href="produto/cadastroProduto.html" title="Produtos">Produtos</a></li>
             <li><a href="usuario/cadastro.html" title="Usuários">Usuários</a></li>
             </ul></li>
             </ul></li>',
             $html);
        }
            
    }

}else
 echo $adm->mensagemErro($_GET['erro']);
 $html = str_replace('{{nome}}'," ",$html);
 $html = str_replace('{{adm}}'," ",$html);
 $html = str_replace('{{deslogar}}'," ",$html);
 $html = str_replace('{{deslogado}}'," ",$html);
?>

<?php

 //CATALOGO PLANTA
    $plantas = $adm->view("plantas");
    $plantas_sub = "";
 
    
    if(count($plantas)>0){
        echo "&nbsp‎";
    foreach($plantas as $planta){   
        
        $plantas_sub = $plantas_sub."<div class='item'><div class='item-entry'><a class='product-item md-height bg-gray d-block'><img style='width: 250px;height: 250px;' src='Upload/Plantas/".$planta['img']."' alt='Image' class='img-fluid'></a>";
        $plantas_sub = $plantas_sub."<h2 class='item-title'><a>".$planta['nome']."</a></h2>";
        $plantas_sub = $plantas_sub."<strong class='item-price'>R$".$planta['valor']."</strong> 
       </div></div>\n \n";
    
    }
    

    }

     //CATALOGO produtos

    $produtos = $adm->view("produtos");
    $produto_sub = "";
 
    
    if(count($produtos)>0){
        echo "&nbsp‎";
    foreach($produtos as $produto){   
        
        $produto_sub = $produto_sub."<div class='item'><div class='item-entry'><a class='product-item md-height bg-gray d-block'><img style='width: 250px;height: 250px;' src='Upload/Produtos/".$produto['img']."' alt='Image' class='img-fluid'></a>";
        $produto_sub = $produto_sub."<h2 class='item-title'><a>".$produto['nome']."</a></h2>";
        $produto_sub = $produto_sub."<strong class='item-price'>R$".$produto['valor']."</strong> 
       </div></div>\n \n";
    
    }
    

    }
    $html = str_replace('{{plantas}}',$plantas_sub,$html);
     $html = str_replace('{{produtos}}',$produto_sub,$html);
//header("location:index.html");
echo $html;
?>