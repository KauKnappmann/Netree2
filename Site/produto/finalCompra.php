<?php 
try{
    include_once "../conf/Conexao.php";
    
    require "../classes/adm.php";
    
    $pdo = Conexao::getInstance();
    $adm = new Adm($pdo);
    }catch(Exception $e){
        echo $e->getCode();
    }

    


session_start();   


$html = file_get_contents("CompraFinalizada.html"); 


$item="";
$valorTotalItem=0;
if(isset($_SESSION['carrinho']))
foreach($_SESSION['carrinho'] as $itens){
    $valorTotalItem=$itens[3]*$itens[2]; 
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
                      
                    </tr>';

}
if($_GET != null)
header("location:carrinho.php");
$html = str_replace('{{carrinho}}',$item,$html);
$html = str_replace('{{total}}',$_POST['valor'] ,$html);
echo $html

?>