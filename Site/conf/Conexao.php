<?php
  include_once "conf.inc.php";

  class Conexao {  
  
    private static $pdo;
  
    private function __construct() {  
    } 
  
    public static function getInstance() {  
      if (!isset(self::$pdo)) {  
        try {  
          $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', 
                          //PDO::ATTR_PERSISTENT => TRUE, na internet pediu pra tirar pra parar de aparecer PDO::__construct(): MySQL server has gone away i
                          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

          self::$pdo = new PDO(DRIVER.
                               ":host=" . HOST . 
                               "; dbname=" . DB_NAME . 
                               "; charset=" . CHARSET . 
                               ";", USER, PASSWORD, 
                               $opcoes);  

        } catch (PDOException $e) {  
          print "Erro: " . $e->getMessage();  
        }  
      }  
      return self::$pdo;  
    }  
  }
?>