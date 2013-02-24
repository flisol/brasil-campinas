<?php
class Users extends BaseAPI {

  public static $users = [];

  public function docs() {
    if ($this->getMethod() != 'get')
      $this->sendResponse(405);
  }

  public function add() {
    if ($this->getMethod() != 'post')
      $this->sendResponse(405);


  }

  public function get($id) {
    if ($this->getMethod() != 'get')
      $this->sendResponse(405);

  }

  public function all($page, $amount = 999) {
    
  }

}

?>
