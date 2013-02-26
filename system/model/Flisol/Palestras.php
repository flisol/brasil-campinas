<?php
/**
 * This is an automatic generated Model by Reverse Migrations at PhpBURN Framework
 * You can find more information about it at http://www.phpburn.com
 *
 * The identation here follows the 2 spaces identation.
 * Please change this documentation for your model information.
 *
 * PhpBURN is distributed under GPL licence for development and cannot be sold.
 * Do not forget to support Open Sources iniciatives, they provide tools like you this.
 *
 * @author Klederson Bueno <klederson@klederson.com>
 * @see http://www.phpburn.com
 * @license GPL
 * @package Flisol 
 */
class Palestras extends PhpBURN_Core {
  public $_tablename = "Palestras";
  public $_package = "Flisol";


  public $idPalestra; 
  public $idPalestrante; 
  public $titulo; 
  public $resumo; 
  public $descricao; 
  public $data; 
  public $dataCriacao; 
  public $local;

  public function _mapping() {
    $this->getMap()->addField( "idPalestra","idPalestra", "int", 10, array("primary" => 1, "not_null" => 1, "auto_increment" => 1) );
    $this->getMap()->addField( "idPalestrante","idPalestrante", "int", 10, array("not_null" => 1) );
    $this->getMap()->addField( "titulo","titulo", "varchar", 50, array("not_null" => 1) );
    $this->getMap()->addField( "resumo","resumo", "varchar", 255, array("not_null" => 1) );
    $this->getMap()->addField( "local","local", "varchar", 255, array("not_null" => 1) );
    $this->getMap()->addField( "descricao","descricao", "text", NULL, array("not_null" => 1) );
    $this->getMap()->addField( "data","data", "datetime", NULL, array("not_null" => 1) );
    $this->getMap()->addField( "dataCriacao","dataCriacao", "timestamp", null, array("not_null" => 1, "default_value" => 'CURRENT_TIMESTAMP') );

  }
  
  /* Do not change anything above this line unless you really know what are you doing */
  /* Put all your customized code bellow this line */
  
  public function getUrl() {
    $url = $this->titulo;
    
    $table = array(
        'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', ' ' => '_'
    );
    
    $url = strtr($url,$table);
    $url = strtolower($url);
    
    $url = $this->idPalestra . ',' . $url;
    
    return $url;
  }
  
}
?>
