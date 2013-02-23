<?php

/**
 * This is an extensible class that allows you to create a RestServer using
 * PhpBURN.
 * 
 * It controls all requisitions and data handle for more information about its
 * usage please check it out on docs.phpburn.com
 * 
 * This RestServer was built thanks to some very interesting readings about:
 * 
 * http://restpatterns.org/RFC_2616_-_Hypertext_Transfer_Protocol_--_HTTP%2F%2F1.1
 * http://www.gen-x-design.com/archives/create-a-rest-api-with-php/
 * 
 * Thaks to them all.
 * 
 * @author Klederson Bueno
 * @version 1.0
 * @package PhpBURN
 * @subpackage RestServer
 */
abstract class RestServer extends Controller {

  private $body;
  private $contentType;
  private $inputFormat;
  private $method;
  protected $allowedContentTypes = array(
      'application/json' => 'json',
      'multipart/form-data' => 'formdata',
      'application/x-www-form-urlencoded' => 'formdata',
      'text/plain' => 'formdata'
  );
  private $responseHeaders = array();

  public function __construct() {
    if (!$this->validateContentType()) {
      $accept = implode(', ', $this->allowedContentTypes);
      $this->sendResponse(406, array('error' => "The given Content-type in your header is not allowed/supported please check-out this api documentation"), array('Accept', $accept));
    }
    $this->setMethod($_SERVER['REQUEST_METHOD']);

    //the body data content will ALWAYS be outputed as a stdObject
    switch ($this->getMethod()) {
      case 'get':
        $this->body = RestTools::parseBody($_GET, 'array');
        break;
      default:
        $this->body = RestTools::parseBody(file_get_contents('php://input'), $this->getInputFormat());
        break;
    }

    //Calls Controller
    parent::__construct();
  }

  /**
   * This retreives authentication data sent
   * 
   * @param Array $params
   * @param String $type
   * @return Array 
   */
  public function getAuthData(array $params = array(), $type = 'basic') {
    //For now we support only BASIC AUTHENTICATION
    $data['username'] = $_SERVER['PHP_AUTH_USER'];
    $data['password'] = $_SERVER['PHP_AUTH_PW'];

    return $data;
  }

  public function sendResponse($status, array $content = array(), array $headers = array(), $contentType = "application/json") {
    $headers = array_merge($this->responseHeaders, $headers);
    
    $body = count($content) > 0 ? ['content' => $content] : [];

    $format = $this->allowedContentTypes[$contentType];

    RestTools::sendResponse($status, $body, $contentType, $format, $headers);
  }

  /**
   * This method verifies if client setted up a compatible content type for this
   * RestServer.
   * 
   * @return boolean 
   */
  protected function validateContentType() {
    //hook to accept all content types
    if (count($this->allowedContentTypes) == 0)
      return TRUE;

    foreach ($this->allowedContentTypes as $contentType => $format) {
      if (preg_match("($contentType)", $_SERVER['CONTENT_TYPE'])) {
        $this->contentType = $contentType;
        $this->inputFormat = $format;
        return TRUE;
      }
    }

    return FALSE;
  }

  public function setBody(stdClass $body) {
    $this->body = $body;
  }

  public function setMethod($method) {
    $this->method = !empty($method) ? strtolower($method) : 'get';
  }

  public function getAllowedContentTypes() {
    return $this->allowedContentTypes;
  }

  public function getBody() {
    return $this->body;
  }

  public function getMethod() {
    return $this->method;
  }

  public function getContentType() {
    return $this->contentType;
  }

  public function getInputFormat() {
    return $this->inputFormat;
  }

  public function setAllowedContentTypes(array $contentTypes) {
    $this->allowedContentTypes = $contentTypes;
  }

  public function getHeaders() {
    return $_SERVER;
  }

  public function getHeader($name) {
    return $_SERVER[$name];
  }

}

?>