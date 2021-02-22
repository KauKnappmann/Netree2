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

$html = file_get_contents("carrinho.html");
$infos = $adm->view($tipo);

$infos = $infos[$cod];
$valorTotalItem=$quantidade*$infos['valor'];

$item = '<tr>
                      <td class="product-thumbnail">
                        <img src="../Upload/'.$tipo.'/'.$infos['img'].'" alt="Image" class="img-fluid">
                      </td>
                      <td class="product-name">
                        <h2 class="h5 text-black">'.$infos['nome'].'</h2>
                      </td>
                      <td>$'.$infos['valor'].'</td>
                      <td>                    
                          <p>'.$quantidade.'</p>
                      </td>
                      <td>'.$valorTotalItem.'</td>
                      <td><a href="#" class="btn btn-primary height-auto btn-sm">X</a></td>
                    </tr>';

$total = '<h2 class="h5 text-black">R$ '.$valorTotalItem.'</h2>';

$html = str_replace('{{item}}',$item,$html);
$html = str_replace('{{total}}',$total,$html);
echo $html

?>