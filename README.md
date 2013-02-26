# Instalação da API

## Guia Rápido para instalação da API

##### Baixando a Aplicação

> Baixe a apliação e configure o banco de dados

    $ git clone git://github.com/FLISOL/brasil-campinas.git -b api apiFlisol
    $ cd apiFlisol
    $ cd mer
    $ mysql -u {{seuusuarioroot}} -p < mer.sql


##### Configurando o MysQL

> Adicione o usuário para acessar o banco Flisol que foi criado

    $ mysql -u {{seuusuarioroot}} -p
    $ mysql> GRANT ALL ON Flisol.* TO 'flisol'@'localhost' IDENTIFIED BY 'flisol';
    $ mysql> FLUSH PRIVILEGES;
    $ mysql> exit


##### Configurando o MongoDB

> se você não tiver o MongoDB instalado por favor google para saber como instalar 

    $ mongo
    $ > use Flisol
    $ > db.addUser('flisol','flisol')
    $ > exit

Pronto agora ambos os bancos de dados estão criados e usuários estão setados.

## Configurando o PHPBURN

> Para utilizar o PHPBURN você NÃO PRECISA incluir ele inteiro na sua aplicação, mas sim utiliza-lo como um include global configurando seu include_path no php.ini.

    $ git clone git://github.com/phpburn/phpburn.git
    $ sudo vim /etc/php5/apache2/php.ini
    $ include_path="{TUDO QUE VC JA TIVER}:{{PATH PARA O PHPBURN}}"

Feito isso reinicie o Apache e o PHPBURN estará pronto para uso.

# Utilizando a API REST

> VALE LEMBRAR QUE ESTA API ESTÁ EM CONSTANTE DESENVOLVIMENTO E ENCONTRA-SE EM FASE BETA ENTÃO TODO E QUALQUER RISCO É POR SUA CONTA NÓS NÃO NOS RESPONSABILIZAMOS POR EVENTUAIS PROBLEMAS

## Adicionando Inscritos

**Configurações REST**

| Configuração  | Valor         | Obrigatório  |
| ------------- |:-------------|:------------:|
| URL | http://localhost/users/add/ | sim        |
| Content-Type | application/json | sim        |
| Method | POST | sim        |

**Data**

    {
      "nome":"Klederson Bueno",
      "sobrenome":"Bezerra da Silva",
      "rg":"123456",
      "email":"klederson@phpburn.com",
      "website":"www.phpburn.com",
      "cidade":"Rio Branco",
      "estado":"AC"
    }

| Campo  | Tipo         | Obrigatório  |
| ------------- |:-------------|:------------:|
| nome | String | sim        |
| sobrenome | String | sim        |
| rg | String | sim        |
| email | String | sim        |
| website | String | não        |
| cidade | String | sim        |
| estado | String | sim        |


## Listando um único usuário

**Configurações REST**

| Configuração  | Valor         | Obrigatório  |
| ------------- |:-------------|:------------:|
| URL | http://localhost/users/get/{{UUID}} | sim        |
| Content-Type | application/json | sim        |
| Method | POST | sim        |

**Data**
> Não existe um body para esta requisição

| Campo  | Tipo         | Obrigatório  |
| ------------- |:-------------|:------------:|
| uuid | String | sim        |


## Listando todos os usuários

**Configurações REST**

| Configuração  | Valor         | Obrigatório  |
| ------------- |:-------------|:------------:|
| URL | http://localhost/inscricoes/find/ | sim        |
| Content-Type | application/json | sim        |
| Method | POST | sim        |

**Data**
> Não existe um body para esta requisição

| Parametros    | Tipo          | Obrigatório  | Descrição |
| --------------|:-------------:|:------------:|:----------|
| page | Integer | não  | Define a partir de qual página os registros serão trazidos |
| filter | String | não  | Este filtro adiciona uma espécie de busca assim restringindo melhor os resultados |
| amount | Integer | não  | Define a quantidade máxima de itens a serem retornados |

Exemplo

    http://localhost/users/find/1/klederson/100

> O exemplo acima trará no máximo 100 usuários a partir da página 1 onde algum termo de match com klederson

