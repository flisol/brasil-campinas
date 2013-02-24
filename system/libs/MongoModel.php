<?php

class MongoModel {

  private static $server = "0001.mongodb.database.in.ifind.com.br";

  //from original model
  private $_settings = NULL;

  //model itself original from MySQL/MSSQL/etc...
  private $_model = NULL;
  
  private static $_connections = [];
  private static $_databases = [];

  private function getModel() {
    return $this->_model;
  }

  private function getSettings() {
    return $this->_settings;
  }

  private function conn() {
    if (empty(self::$_connections[$this->getSettings()->package])) {
      $connString = sprintf("mongodb://%s:%s@%s", $this->getSettings()->user, $this->getSettings()->password, self::$server);
      self::$_connections[$this->getSettings()->package] = new MongoClient($connString);
    }

    return self::$_connections[$this->getSettings()->package];
  }

  private function db() {
    if (empty(self::$_databases[$this->getSettings()->package]))
      self::$_databases[$this->getSettings()->package] = $this->conn()->selectDB($this->getSettings()->database);

    return self::$_databases[$this->getSettings()->package];
  }

  private function collection() {
    $collection = $this->getModel()->_tablename;
    return $this->db()->$collection;
  }

  public function save($keepId = TRUE) {
    $pkField = $this->getModel()->getMap()->getPrimaryKey(TRUE);

    $data = $this->getModel()->toArray();

    if ($keepId == TRUE)
      $data['_id'] = $this->getModel()->$pkField['field']['alias'];

    $this->collection()->save($data);
  }

}

?>