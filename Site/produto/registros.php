<?php 
try{
    include_once "../conf/Conexao.php";
    
    require "../classes/adm.php";
    
    $pdo = Conexao::getInstance();
    $adm = new Adm($pdo);
    }catch(Exception $e){
        echo $e->getCode();
    }

$table = isset($_GET['table']) ? $_GET['table'] : null;
$edit = isset($_GET['edit']) ? $_GET['edit'] : null;
$toEdit = isset($_GET['toEdit']) ? $_GET['toEdit'] : null;
$delete = isset($_GET['delete']) ? $_GET['delete'] : null;

$html = file_get_contents("registros.html");

if($toEdit != null){
  $temp = array(
    "nome" => $_GET['nome'],
    "tipo" => $_GET['tipo'],
    "valor" => $_GET['valor'],
    "estoque" => $_GET['estoque']
  );
 
 $adm->update($table,$temp,$toEdit);
}

if($delete != null)
    $adm->delete($table,$delete);
  
$tableInfos = $adm->view($table);
$sub = "";


if(count($tableInfos)>0){

foreach($tableInfos as $tableInfo){   
  
  if($edit == $tableInfo['cod']){
    $sub = $sub."<tr><th scope='row'></th><td><form><input type='text' value='".$tableInfo['nome']."' name='nome'></td>
    <td><form><input type='text' value='".$tableInfo['tipo']."' name='tipo'></td><td><form><input type='text' value='".$tableInfo['valor']."' name='valor'></td><td><form><input type='text' value='".$tableInfo['estoque']."' name='estoque'></td>
    <td><img style='width: 50px;height: 50px;' src='../Upload/".$table."/".$tableInfo['img']."'></td>
    <td><form action='registros.php' method='GET'><input type='hidden' name='table' value='".$table."'><button class='btn-sm btn-outline-primary' name='toEdit' value='".$tableInfo['cod']."' type='submit'>enviar</button></form></td>
    
    </tr>";
    }else{
      $sub = $sub."<tr><th scope='row'></th><td>".$tableInfo['nome']."</td>
     <td>".$tableInfo['tipo']."</td><td>".$tableInfo['valor']."</td><td>".$tableInfo['estoque']."</td>
     <td><img style='width: 50px;height: 50px;' src='../Upload/".$table."/".$tableInfo['img']."'></td>
     <td><form action='registros.php' method='GET'><input type='hidden' name='table' value='".$table."'><button class='btn-sm btn-outline-primary' name='edit' value='".$tableInfo['cod']."' type='submit'>#</button></form></td>
     <td><form action='registros.php' method='GET'><input type='hidden' name='table' value='".$table."'><button class='btn-sm btn-outline-primary' name='delete' value='".$tableInfo['cod']."'  type='submit'>X</button></form></td>
     </tr>";
    }
  }
}

$html = str_replace('{{mostrar}}',$sub,$html);
echo $html;
?>