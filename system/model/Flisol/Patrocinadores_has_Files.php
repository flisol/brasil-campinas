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
class Patrocinadores_has_Files extends PhpBURN_Core {
  public $_tablename = "Patrocinadores_has_Files";
  public $_package = "Flisol";


  public $idPatrocinadoresHasFiles; 
  public $idPatrocinador; 
  public $idFile; 

  public function _mapping() {
    $this->getMap()->addField( "idPatrocinadoresHasFiles","idPatrocinadoresHasFiles", "int", 10, array("primary" => 1, "not_null" => 1, "auto_increment" => 1) );
    $this->getMap()->addField( "idPatrocinador","idPatrocinador", "int", 10, array("not_null" => 1) );
    $this->getMap()->addField( "idFile","idFile", "int", 10, array("not_null" => 1) );

  }
  
  /* Do not change anything above this line unless you really know what are you doing */
  /* Put all your customized code bellow this line */
  
}
?>
