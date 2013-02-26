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
class Usuarios extends PhpBURN_Core {
  public $_tablename = "Usuarios";
  public $_package = "Flisol";


  public $idUsuario; 
  public $nome; 
  public $sobrenome; 
  public $login; 
  public $password; 
  public $status; 
  public $genero; 
  public $nascimento; 
  public $dataCriacao; 

  public function _mapping() {
    $this->getMap()->addField( "idUsuario","idUsuario", "int", 10, array("primary" => 1, "not_null" => 1, "auto_increment" => 1) );
    $this->getMap()->addField( "nome","nome", "varchar", 45, array("not_null" => 1) );
    $this->getMap()->addField( "sobrenome","sobrenome", "varchar", 255, array("not_null" => 1) );
    $this->getMap()->addField( "login","login", "varchar", 255, array("not_null" => 1) );
    $this->getMap()->addField( "password","password", "text", 65535, array("not_null" => 1) );
    $this->getMap()->addField( "status","status", "enum('active','blocked','suspense','deleted')", null, array("not_null" => 1, "default_value" => 'active') );
    $this->getMap()->addField( "genero","genero", "enum('m','f')", null, array("not_null" => 1) );
    $this->getMap()->addField( "nascimento","nascimento", "datetime", null, array("not_null" => 1) );
    $this->getMap()->addField( "dataCriacao","dataCriacao", "timestamp", null, array("not_null" => 1, "default_value" => 'CURRENT_TIMESTAMP') );

    $this->getMap()->addRelationship("Posts", self::ONE_TO_MANY, "Posts", "idUsuario", "idAutor");
  }
  
  /* Do not change anything above this line unless you really know what are you doing */
  /* Put all your customized code bellow this line */
  
}
?>
