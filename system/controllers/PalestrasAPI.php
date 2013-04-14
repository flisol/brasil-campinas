<?php
/**
 * API de Palestras do Flisol Campinas
 * 
 * @author Klederson Bueno <klederson@phpburn.com>
 * @version 1
 * @package Flisol
 * @subpackage API
 */
class PalestrasAPI extends BaseAPI {

  public function index() {
    $httpStatus = 200;
    $response['status'] = self::OK;
    $response['messages']['success'] = PhpBURN_Views::lazyTranslate("[!Documentação não implementada!]");

    $this->sendResponse($httpStatus, $response, []);
  }

  /**
   * Cria um novo registro na base de inscritos e aceita apenas POST como metodo (por hora).
   * 
   * @param String $nome
   * @param String $sobrenome
   * @param String $rg
   * @param String $email
   * @param String $email
   * @param String $cidade
   * @param String $estado
   * 
   * @return JSON
   */ 
  public function add() {
    if ($this->getMethod() != 'post')
      $this->sendResponse(405);

    $data = $this->getBody();

    $palestra = new Palestras();

    $palestra->titulo = $data->titulo;
    $palestra->resumo = $data->resumo;
    $palestra->descricao = $data->descricao;
    $palestra->status = 'submetida';
    
    if($palestra->save()) {
      //Este é um HOOK para salvar também no mongo ( Ele mantem o id caso seja um update ou insere um novo dado na tabela )
      //Vale lembrar que por hora apenas iremos armazenar os dados no mongo como redundância e para uso futuro
      //Este é um bom exemplo da flexibilidade da API
      $mongoVersion = new MongoModel($palestra);
      $mongoVersion->save();

      $httpStatus = 200;
      $response['content'] = $palestra->toArray();
      $response['status'] = self::OK;
      $response['messages']['success'] = PhpBURN_Views::lazyTranslate("[!Palestra cadastrada com sucesso!] [!Aguarde aprovação!]");
    } else {
      $httpStatus = 400;
      $response['status'] = self::ERROR;
      $response['messages']['error'] = PhpBURN_Views::lazyTranslate("[!Não foi possível cadastrar esta palestra, entre em contato com o suporte!]");
    }

    //envia resposta pro browser
    $this->sendResponse($httpStatus, $response, []);
  }

  /**
   * Busca por uma palestraa específica baseado no ID da mesma
   * Aceita métodos GET
   * 
   * @param String $id
   * 
   * @return JSON
   */ 
  public function get($id) {
    if ($this->getMethod() != 'get')
      $this->sendResponse(405);

    $palestra = new Palestras();

    if($palestra->where('idPalestra','=',$id)->find() == 1) {
      $httpStatus = 200;
      $response['content'] = $palestra->toArray();
      $response['status'] = self::OK;
      $response['messages']['success'] = PhpBURN_Views::lazyTranslate("[!Palestra Encontrada!]");
    } else {
      $httpStatus = 400;
      $response['status'] = self::ERROR;
      $response['messages']['error'] = PhpBURN_Views::lazyTranslate("[!Não foi possível localizar esta palestra!]");
    }

    //envia resposta pro browser
    $this->sendResponse($httpStatus, $response, []);
  }

  /**
   * Lista todas as palestras cadastradas
   * Aceita métodos GET
   * 
   * @param Integer $page
   * @param String $filter
   * @param Integer $amount
   * 
   * @return JSON
   */ 
  public function find($page = 1, $amount = 999, $filter = NULL) {
    if ($this->getMethod() != 'get')
      $this->sendResponse(405);

    $page = $page <= 1 ? 0 : $page - 1;

    $model = new Palestras;

    if(!empty($filter)) {
      $serchFields =["titulo","resumo","descricao"];

      //definir dentro dos campos "buscáveis" um like pro filtro
      foreach($serchFields as $field) {
        $search ="%$filter%";
        $model->like($field,$search,'OR'); //adiciona o like pro campo $field
      }
    }

    //define a paginação e faz a busca
    if( $model->limit($page*$amount,$amount)->find() > 0 ) {
      $httpStatus = 200;
      $response['status'] = self::OK;
      $message = sprintf("(%s) usuário(s) encontrado(s)",$model->getAmount());
      $response['messages']['success'] = PhpBURN_Views::lazyTranslate($message);

      //parsear item a item pra poder remover o RG
      while($model->fetch()) {
        $model->getRelationship('Palestrante')->fetch();
        $model->Palestrante->rg = PhpBURN_Views::lazyTranslate("([!ESTE DADO NAO É EXIBIDO POR QUESTOES DE PRIVACIDADE!])");
        $model->Palestrante->email = PhpBURN_Views::lazyTranslate("([!ESTE DADO NAO É EXIBIDO POR QUESTOES DE PRIVACIDADE!])");
        $model->idPalestrante = PhpBURN_Views::lazyTranslate("([!ESTE DADO NAO É EXIBIDO POR QUESTOES DE PRIVACIDADE!])");
        $response['content'][] = $model->toArray();
      }
    } else {
      $httpStatus = 400;
      $response['status'] = self::ERROR;
      $response['messages']['error'] = PhpBURN_Views::lazyTranslate("[!Nenhuma palestra encontrada!]");
    }

    //envia resposta pro browser
    $this->sendResponse($httpStatus, $response, []);
  }

}

?>
