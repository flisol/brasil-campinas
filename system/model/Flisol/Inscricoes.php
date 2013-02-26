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
class Inscricoes extends PhpBURN_Core {
  public $_tablename = "Inscricoes";
  public $_package = "Flisol";


  public $idInscricao; 
  public $nome; 
  public $sobrenome; 
  public $rg; 
  public $email; 
  public $website; 
  public $dataCriacao; 

  public function _mapping() {
    $this->getMap()->addField( "idInscricao","idInscricao", "int", 10, array("primary" => 1, "not_null" => 1, "auto_increment" => 1) );
    $this->getMap()->addField( "nome","nome", "varchar", 45, array("not_null" => 1) );
    $this->getMap()->addField( "sobrenome","sobrenome", "varchar", 255, array("not_null" => 1) );
    $this->getMap()->addField( "rg","rg", "varchar", 45, array("not_null" => 1) );
    $this->getMap()->addField( "uuid","uuid", "varchar", 45, array("not_null" => 1) );
    $this->getMap()->addField( "email","email", "varchar", 255, array("not_null" => 1) );
    $this->getMap()->addField( "website","website", "varchar", 45, array() );
    $this->getMap()->addField( "cidade","cidade", "varchar", 45, array() );
    $this->getMap()->addField( "tipo","tipo", 'enum', "('staff','palestrante','regular','vip','press')", array('default_value' => 'regular') );
    $this->getMap()->addField( "dataCriacao","dataCriacao", "timestamp", null, array("not_null" => 1, "default_value" => 'CURRENT_TIMESTAMP') );

  }
  
  /* Do not change anything above this line unless you really know what are you doing */
  /* Put all your customized code bellow this line */
  
}
?>
