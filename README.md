# API Flisol Campinas

## Instalação da API

Guia Rápido para instalação da API

    $ git clone git://github.com/FLISOL/brasil-campinas.git -b api apiFlisol
    $ cd apiFlisol
    $ cd mer
    $ mysql -u {{seuusuarioroot}} -p < mer.sql

Adicione o usuário para acessar o banco Flisol que foi criado

    $ mysql -u {{seuusuarioroot}} -p
    $ mysql> GRANT ALL ON Flisol.* TO 'flisol'@'localhost' IDENTIFIED BY 'flisol';
    $ mysql> FLUSH PRIVILEGES;
    $ mysql> exit

Agora vamos configurar o mongodb ( se você não tiver por favor google para saber como instalar )

    $ mongo
    $ > use Flisol
    $ > db.addUser('flisol','flisol')
    $ > exit

Pronto agora ambos os bancos de dados estão criados e usuários estão setados.

### Configurando o PHPBURN

Para utilizar o PHPBURN você NÃO PRECISA incluir ele inteiro na sua aplicação, mas sim utiliza-lo como um include global
configurando seu include_path no php.ini.

    $ git clone git://github.com/phpburn/phpburn.git
    $ sudo vim /etc/php5/apache2/php.ini
    $ include_path="{TUDO QUE VC JA TIVER}:{{PATH PARA O PHPBURN}}"

Feito isso reinicie o Apache e o PHPBURN estará pronto para uso.

