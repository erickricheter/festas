# projeto_festas.com

## Integrantes do projeto:

-   Erick Eduardo Richeter
-   Luiz Felipe Salache De Souza

## Resumo do Projeto

Projeto em PHP de um sistema de cadastro de eventos, onde os usuário podem cadastrar visualizar e contratar os eventos.

## Atividades exercidas pelos participantes do projeto na entrega 01

-   O projeto foi separado básicamente por páginas e fluxos

1. Erick Eduardo Richeter

-   Criação das páginas de view;
-   Criação dos controllers de cadastro do sistema e integração com o models para funcionamento dos mesmo;
-   Stylização principal do projeto;

2. Luiz Felipe Salache De Souza

-   Adição do cadastro de eventos ao projeto;
-   Adição do perfil ao projeto;
-   Revisão dos controllers;
-   Revisão do novo evento no index.

## Atividades exercidas pelos participantes do projeto na entrega 02

1. Erick Eduardo Richeter

-   Padronização OOP do projeto;
-   Criação do sistema de Banco de dados + eventos + Phinx

2. Luiz Felipe Salache De Souza

-   Alterações na estrutura do index
-   Testes do Composer
-   Rotas iniciais do projeto

### Getting Started

-   Adicionar as dependencias do projeto com composer install
-   Inicar o MySql via xampp e abrir a página localhost/phpmyadmin
-   Criar a data base de nome: "development_db"
-   Na página do projeto rodar o seguinte comando: vendor/bin/phinx migrate
-   Abrir outra aba do navegador com localhost
-   Rodar o projeto

## Atividades exercidas pelos participantes do projeto na entrega 03

1. Erick Eduardo Richeter

-   Criação do controller e rotas do usuário, assim como a validação e autenticação do usuário.
-   Desenvolvimento do CRUD de usuários.
-   Criação do banco de dados atrávez do laravel sanctum;

2. Luiz Felipe Salache

-   Criação do controller e rotas dos eventos, validação da autenticação passada pelo controller do usuário;
-   Desenvolvimento do CRUD dos eventos.

### Getting Started

-   Adicionar as dependencias do projeto com composer install e update;
    > Caso necessário rodar o comando: composer require laravel/sanctum;
-   Inicar o MySql via xampp;
-   Rodar os seguintes comandos em ordem:
    > php artisan migrate;
    > php artisan config:cache;
    > php artisan server;
-   Após rodar o servidor pode ser iniciado os testes de rotas:

    > Rotas de usuário:

-   {{ _.baseURL }}/register
    > Exemplo de json: {"name": "erick","email": "luiz@gmail.com", "password": "123456"}
-   {{ _.baseURL }}/login
-   {{ _.baseURL }}/logout
-   {{ _.baseURL }}/user/{id} - Mostra o usuário pelo id
-   {{ _.baseURL }}/users - Lista todos os usuários
-   {{ _.baseURL }}/user/{id} - UPDATE no user pelo id
-   {{ _.baseURL }}/user/{id} - Delete no user pelo id

-   > Rotas dos eventos:

-   {{ _.baseURL }}/events - Cria o evento
    > Exemplo de json:{"name" : "Fessta da Uva 20223","description": "A melhor festa da uva que vc ja viu! Apenas ess22e ano","date" : "2023-06-29", "place" : "Avenida 22munchen", "value": 1500}
-   {{ _.baseURL }}/events/{id} - Mostra o evento pelo seu id
-   {{ _.baseURL }}/events - Lista todos os eventos
-   {{ _.baseURL }}/events/{id} - Update no evento pelo id
-   {{ _.baseURL }}/events/{id} - Delete no evento pelo id
