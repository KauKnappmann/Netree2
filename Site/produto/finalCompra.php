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

$finalizou = isset($_POST['final']) ? $_POST['final'] : 0;

if($finalizou==1){

$_SESSION['carrinho'] = null;
header("location: ../home.php");
}
$html = file_get_contents("CompraFinalizada.html"); 


$item="";
$valorTotalItem=0;
if(isset($_SESSION['carrinho']))
foreach($_SESSION['carrinho'] as $itens){
    $valorTotalItem=$itens[3]*$itens[2]; 
    $item = $item.'<tr>
                      <td class="product-thumbnail">
                        
                        <img src="../Upload/'.$itens[4].'" style="width: 40px;height: 40px;" alt="Image" class="img-fluid">
                      </td>
                      <td class="product-name">
                        
                        <h6 class="text-black">'.$itens[1].'</h6>
                      </td>
                      
                      <td>$'.$itens[2].'</td>
                      <td>                    
                          
                          <p>'.$itens[3].'</p>
                      </td>
                      <td>'.$valorTotalItem.'</td>
                      
                    </tr>';

}

$html = str_replace('{{carrinho}}',$item,$html);
$html = str_replace('{{total}}',$_POST['valor'] ,$html);
echo $html

?>