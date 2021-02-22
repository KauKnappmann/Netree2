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
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;
    $nome = isset($_GET['nome']) ? $_GET['nome'] : null;
    $valor = isset($_GET['valor']) ? $_GET['valor'] : null;
    $img = isset($_GET['img']) ? $_GET['img'] : null;
    $quantidade = isset($_GET['quantidade']) ? $_GET['quantidade'] : 1;

//$toProd = $adm->view();

session_start();   

if($cod != null || $tipo !=null){
if(!isset($_SESSION['carrinho']))
$_SESSION['carrinho'] = array(array($cod,$nome,$valor,$quantidade,$img,$tipo));
  else
  $_SESSION['carrinho'][] = array($cod,$nome,$valor,$quantidade,$img,$tipo);
}


$delete = isset($_GET['delete']) ? $_GET['delete'] : null;

if($delete!=null){ 
 $_SESSION['carrinho'][$delete] = null;
 
}
$html = file_get_contents("carrinho.html"); 

$valorFinal = 0;
$aux=0;
$item="";

if(isset($_SESSION['carrinho']))
foreach($_SESSION['carrinho'] as $itens){

  if($itens != null){
    
 $valorTotalItem=$itens[3]*$itens[2]; 
 

$valorFinal +=$valorTotalItem;

    $item = $item.'<tr>
                      <td class="product-thumbnail">
                        
                        <img src="../Upload/'.$itens[4].'" alt="Image" class="img-fluid">
                      </td>
                      <td class="product-name">
                        
                        <h2 class="h5 text-black">'.$itens[1].'</h2>
                      </td>
                      
                      <td>$'.$itens[2].'</td>
                      <td>                    
                          
                          <p>'.$itens[3].'</p>
                      </td>
                      <td>'.$valorTotalItem.'</td>
                      <td><a href="carrinho.php?delete='.$aux.'" class="btn btn-primary height-auto btn-sm">X</a></td>
                    </tr>';
                  }
  $aux+=1;
                    
}
if($_GET != null)
header("location:carrinho.php");
$html = str_replace('{{item}}',$item,$html);
$html = str_replace('{{total}}',$valorFinal ,$html);
echo $html

?>