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
class Posts extends PhpBURN_Core {
  public $_tablename = "Posts";
  public $_package = "Flisol";


  public $idPost; 
  public $idAutor; 
  public $titulo; 
  public $conteudoOriginal; 
  public $conteudo; 
  public $dataCriacao; 

  public function _mapping() {
    $this->getMap()->addField( "idPost","idPost", "int", 10, array("primary" => 1, "not_null" => 1, "auto_increment" => 1) );
    $this->getMap()->addField( "idAutor","idAutor", "int", 10, array("primary" => 1, "not_null" => 1) );
    $this->getMap()->addField( "titulo","titulo", "varchar", 255, array("not_null" => 1) );
    $this->getMap()->addField( "conteudoOriginal","conteudoOriginal", "blob", 65535, array("not_null" => 1) );
    $this->getMap()->addField( "conteudo","conteudo", "blob", 65535, array("not_null" => 1) );
    $this->getMap()->addField( "dataCriacao","dataCriacao", "timestamp", null, array("not_null" => 1, "default_value" => 'CURRENT_TIMESTAMP') );

  }
  
  /* Do not change anything above this line unless you really know what are you doing */
  /* Put all your customized code bellow this line */
  
}
?>
