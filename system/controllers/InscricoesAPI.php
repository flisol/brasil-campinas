<?php
/**
 * API de Inscrições do Flisol Campinas
 * 
 * @author Klederson Bueno <klederson@phpburn.com>
 * @version 1
 * @package Flisol
 * @subpackage API
 */
class InscricoesAPI extends BaseAPI {

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

    $user = new Inscricoes();

    $user->nome = $data->nome;
    $user->sobrenome =$data->sobrenome;
    $user->rg = $data->rg;
    $user->uuid = uniqid();
    $user->email = $data->email;
    $user->website = $data->website;
    $user->cidade = $data->cidade;
    $user->estado = $data->estado;
    
    if($user->save()) {
      //Este é um HOOK para salvar também no mongo ( Ele mantem o id caso seja um update ou insere um novo dado na tabela )
      //Vale lembrar que por hora apenas iremos armazenar os dados no mongo como redundância e para uso futuro
      //Este é um bom exemplo da flexibilidade da API
      $mongoVersion = new MongoModel($user);
      $mongoVersion->save();

      $httpStatus = 200;
      $response['content'] = $user->toArray();
      $response['status'] = self::OK;
      $response['messages']['success'] = PhpBURN_Views::lazyTranslate("[!Usuário cadastrado com sucesso!]");
    } else {
      $httpStatus = 400;
      $response['status'] = self::ERROR;
      $response['messages']['error'] = PhpBURN_Views::lazyTranslate("[!Não foi possível cadastrar este usuário, entre em contato com o suporte!]");
    }

    //envia resposta pro browser
    $this->sendResponse($httpStatus, $response, []);
  }

  /**
   * Busca por um usuários específico baseado no Unique ID ( UUID ) do mesmo
   * Aceita métodos GET
   * 
   * @param String $id
   * 
   * @return JSON
   */ 
  public function get($id) {
    if ($this->getMethod() != 'get')
      $this->sendResponse(405);

    $user = new Inscricoes();

    if(is_numeric($id)) {
      $user->where('idUser','=',$id);
    } else {
      $user->where('uuid','=',$id);
    }

    if($user->find() == 1) {
      $httpStatus = 200;
      $user->rg = PhpBURN_Views::lazyTranslate("([!ESTE DADO NAO É EXIBIDO POR QUESTOES DE PRIVACIDADE!])");
      $user->email = PhpBURN_Views::lazyTranslate("([!ESTE DADO NAO É EXIBIDO POR QUESTOES DE PRIVACIDADE!])");
      $response['content'] = $user->toArray();
      $response['status'] = self::OK;
      $response['messages']['success'] = PhpBURN_Views::lazyTranslate("[!Usuário Encontrado!]");
    } else {
      $httpStatus = 400;
      $response['status'] = self::ERROR;
      $response['messages']['error'] = PhpBURN_Views::lazyTranslate("[!Não foi possível localizar este usuário!]");
    }

    //envia resposta pro browser
    $this->sendResponse($httpStatus, $response, []);
  }

  /**
   * Lista todos os usuários cadastrados
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

    $users = new Inscricoes;

    if(!empty($filter)) {
      $serchFields =["nome","sobrenome","email","cidade","estado"];

      //definir dentro dos campos "buscáveis" um like pro filtro
      foreach($serchFields as $field) {
        $search ="%$filter%";
        $users->like($field,$search,'OR'); //adiciona o like pro campo $field
      }
    }

    //define a paginação e faz a busca
    if( $users->limit($page*$amount,$amount)->find() > 0 ) {
      $httpStatus = 200;
      $response['status'] = self::OK;
      $message = sprintf("(%s) usuário(s) encontrado(s)",$users->getAmount());
      $response['messages']['success'] = PhpBURN_Views::lazyTranslate($message);

      //parsear item a item pra poder remover o RG
      while($users->fetch()) {
        $users->rg = PhpBURN_Views::lazyTranslate("([!ESTE DADO NAO É EXIBIDO POR QUESTOES DE PRIVACIDADE!])");
        $users->email = PhpBURN_Views::lazyTranslate("([!ESTE DADO NAO É EXIBIDO POR QUESTOES DE PRIVACIDADE!])");
        $response['content'][] = $users->toArray();
      }
    } else {
      $httpStatus = 400;
      $response['status'] = self::ERROR;
      $response['messages']['error'] = PhpBURN_Views::lazyTranslate("[!Nenhum usuário encontrado!]");
    }

    //envia resposta pro browser
    $this->sendResponse($httpStatus, $response, []);
  }

}

?>
