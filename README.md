# Odin note
[![Build Status](https://travis-ci.org/mathmarques/odin-note.svg)](https://travis-ci.org/mathmarques/odin-note)
[![Coverage Status](https://coveralls.io/repos/github/mathmarques/odin-note/badge.svg?branch=master)](https://coveralls.io/github/mathmarques/odin-note?branch=master)

## Componentes Frontend

* PHP 7 - Versão utilizada para o desenvolvimento
* MySQL - Banco de Dados
* [Composer](https://getcomposer.org) - Gerenciador de dependências 
* [Slim Framework](https://www.slimframework.com/) - Micro-Framework para requisições e rotas
* [Doctrine 2](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/) - Framework ORM para acessar o banco de dados

## Executando o Projeto

1. Clone o código desse repositório para dentro da pasta ``www`` ou ``htdocs`` do seu servidor web com PHP 7 e MySQL
1. Navegue até a pasta do projeto e execute ``composer install`` para instalar as dependências
1. Configure o arquivo ``settings.php`` em ``/app/``
1. Dê permissão de Leitura e Escrita(``chmod -R 777``) para a pasta ``/cache/``
1. Supondo que todas as configurações estão corretas, da raiz da pasta do projeto, execute ``./vendor/bin/doctrine orm:schema-tool:create`` no Mac/Linux ou ``"vendor/bin/doctrine.bat" orm:schema-tool:create`` no Windows para subir o banco de dados
1. O projeto estará acessivel em ``http://localhost/odin-note/public/``

## Observações

* Caso atualize o ``Model`` do projeto, deverá executar o comando ``./vendor/bin/doctrine orm:schema-tool:update`` no Mac/Linux ou ``"vendor/bin/doctrine.bat" orm:schema-tool:update`` no Windows para atualizar o banco de dados
* Caso queira ver o SQL gerado (tanto no ``orm:schema-tool:create`` quanto no ``orm:schema-tool:update``) utilize o argumento ``--dump-sql``. Exemplo: ``./vendor/bin/doctrine orm:schema-tool:create --dump-sql``