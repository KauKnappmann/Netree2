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
    $quantidade = isset($_GET['quantidade']) ? $_GET['quantidade'] : 1;

//$toProd = $adm->view();

session_start();   

if(!isset($_SESSION['carrinho']))
$_SESSION['carrinho'] = array(array($tipo,$cod,$quantidade));
 else
 $_SESSION['carrinho'][] = array($tipo,$cod,$quantidade);


$html = file_get_contents("carrinho.html"); 
$infos = $adm->view($tipo);



$item="";
foreach($_SESSION['carrinho'] as $itens){

    $item = $item.'<tr>
                      <td class="product-thumbnail">
                        
                        <img src="../Upload/'.$itens[0].'/'.$infos[$itens[1]]['img'].'" alt="Image" class="img-fluid">
                      </td>
                      <td class="product-name">
                        
                        <h2 class="h5 text-black">'.$infos[$itens[1]]['nome'].'</h2>
                      </td>
                      
                      <td>$'.$infos[$itens[1]]['valor'].'</td>
                      <td>                    
                          
                          <p>'.$itens[2].'</p>
                      </td>
                      <td>$49.00</td>
                      <td><a href="#" class="btn btn-primary height-auto btn-sm">X</a></td>
                    </tr>';

                    
                }

$html = str_replace('{{item}}',$item,$html);
//$html = str_replace('{{total}}',$total,$html);
echo $html

?>