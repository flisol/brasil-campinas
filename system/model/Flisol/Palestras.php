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
    $this->getMap()->addField( "descricao","descricao", "text", NULL, array("not_null" => 1) );
    $this->getMap()->addField( "data","data", "datetime", NULL, array("not_null" => 1) );
    $this->getMap()->addField( "status", "status", "enum", "submetida,aprovada,rejeitada,cancelada,executada", ["not_null" => 1, "default" => "submetida"]);
    $this->getMap()->addField( "dataCriacao","dataCriacao", "timestamp", null, array("not_null" => 1, "default_value" => 'CURRENT_TIMESTAMP') );

    $this->getMap()->addRelationship("Palestrante", self::ONE_TO_ONE, "Inscricoes", "idPalestrante", "idInscricao");
  }
  
  /* Do not change anything above this line unless you really know what are you doing */
  /* Put all your customized code bellow this line */
  
}
?>
