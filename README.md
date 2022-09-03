# Teste de conhecimento

Este projeto foi feito com o objetivo de servir como um teste de conhecimento do framework Laravel. 

Onde foi solicitado:
- Criar um CRUD de rotas de API para o cadastro de bolos.
- Os bolos deverão ter Nome, Peso (em gramas), Valor, Quantidade disponível e uma lista
  de e-mail de interessados.
- Após o cadastro de e-mails interessados, caso haja bolo disponível, o sistema deve enviar
  um e-mail para os interessados sobre a disponibilidade do bolo.
### Casos a avaliar:
- Pode ocorrer de 50.000 clientes se cadastrarem e o processo de envio de emails não deve
 ser algo impeditivo.

### Podendo desenvolver utilizando as sugestões abaixo.
- [Utilizar fila para o envio de e-mails, caso não domine o conceito de filas poderá ser feito
  sem. ref.](https://laravel.com/docs/8.x/queues)
- [Utilizar Resources para construção da API. ref](https://laravel.com/docs/8.x/eloquent-resources)

## Resolução
- Foi desenvolvido utilizando o Laravel na versão 9x
- Container criado atravez do Laravel Sail

## Para executar o ambiente siga os passaos descritos abaixo:
* Para este desenvolvimento foi utilizado o sistema operacional Linux, espera-se que os comandos a seguir possam ser executadosem outras distibuições também
### Pré requisitos para executar o ambiente:
- Docker
- composer

### Após baixar o repositório, siga os seguintes passos para inicialização e execução do ambiente
- cp .env_test .env 
> Editar as configurações no arquivo .env de acordo com o ambiente de testes
> 
         MAIL_MAILER=smtp 
         MAIL_HOST=
         MAIL_PORT=
         MAIL_USERNAME=
         MAIL_PASSWORD=
         MAIL_ENCRYPTION=

- composer install
- sail up
- sail artisam migrate

### Sugestões para teste das funcionalidades
- [Postman](https://www.postman.com/)
- [Insomnia](https://insomnia.rest/download)
- Curl

## API

Descrição das rotas da API.

### Criar registros de Bolos e enviar os emails para a fila

### Request

`POST /api/cakes`

     curl --request POST \
         --url http://localhost/api/cakes \
         --header 'Authorization: Bearer undefined' \
         --header 'Content-Type: application/json' \
         --data '{
             "nome": "Bolo de fubá",
             "peso": "400",
             "valor": 15.45,
             "quantidade": 5,
             "interest_list": [
                "email_interessado1@gmail.com.br",
                "email_interessado2@gmail.com.br",
                "email_interessado3@gmail.com.br",
                "email_interessado4@gmail.com.br",
                "email_interessado5@gmail.com.br"
             ]
        }'

### Response

    HTTP/1.1 201 Created
    Host: localhost
    Date: Sat, 03 Sep 2022 18:06:09 GMT
    Connection: close
    X-Powered-By: PHP/8.1.9
    Cache-Control: no-cache, private
    Date: Sat, 03 Sep 2022 18:06:09 GMT
    Content-Type: application/json

    {"message": "Bolo cadastrado e emails enviados."}


### Obter todo o cadastro de bolos

### Request

`GET /api/cakes`

    curl http://localhost/api/cakes'

### Response

    HTTP/1.1 200 OK
    Host: localhost
    Date: Sat, 03 Sep 2022 18:08:50 GMT
    Connection: close
    X-Powered-By: PHP/8.1.9

    [
        {
            "id": 1,
            "nome": "Bolo de fubá",
            "peso": 400,
            "valor": 15.45,
            "quantidade": 10,
            "created_at": "2022-09-03T17:50:51.000000Z",
            "updated_at": "2022-09-03T17:50:51.000000Z"
        },
        {
            "id": 2,
            "nome": "Bolo de cenouras",
            "peso": 300,
            "valor": 14.99,
            "quantidade": 5,
            "created_at": "2022-09-03T18:05:30.000000Z",
            "updated_at": "2022-09-03T18:05:30.000000Z"
        },
        {
            "id": 3,
            "nome": "Bolo de fubá cremoso",
            "peso": 500,
            "valor": 30.55,
            "quantidade": 15,
            "created_at": "2022-09-03T18:06:09.000000Z",
            "updated_at": "2022-09-03T18:06:09.000000Z"
        }
    ]

### Obter apenas um bolo específico

### Request

`GET /api/cakes/{id_do_bolo}`

    curl http://localhost/api/cakes/1'


### Response

    HTTP/1.1 200 OK
    Host: localhost
    Date: Sat, 03 Sep 2022 18:08:50 GMT
    Connection: close
    X-Powered-By: PHP/8.1.9

    {
        "id": 1,
        "nome": "Bolo de fubá",
        "peso": 400,
        "valor": 15.45,
        "quantidade": 10,
        "created_at": "2022-09-03T17:50:51.000000Z",
        "updated_at": "2022-09-03T17:50:51.000000Z"
    }

### Atualizar um bolo

### Request

`PUT /api/cakes/{id_do_bolo}`

    curl --request PUT \
        --url http://localhost/api/cakes/1 \
        --header 'Authorization: Bearer undefined' \
        --header 'Content-Type: application/json' \
        --data '{
            "nome": "Bolo de fubáasasdadsdas",
            "peso": "400",
            "valor": 15.45,
            "quantidade": 10,
            "interest_list": [
                "novo_pessoa1@gmail.com.br"
            ]
        }'

### Response

    HTTP/1.1 200 OK
    Host: localhost
    Date: Sat, 03 Sep 2022 18:08:50 GMT
    Connection: close
    X-Powered-By: PHP/8.1.9

    {
        "id": 1,
        "nome": "Bolo de fubá com goiabada",
        "peso": 450,
        "valor": 25.45,
        "quantidade": 18,
        "created_at": "2022-09-03T17:50:51.000000Z",
        "updated_at": "2022-09-03T17:50:51.000000Z"
    }


## Excluir um Bolo

### Request

`DELETE /api/cakes/{id_do_bolo}`

    curl --request DELETE --url http://localhost/api/cakes/4 

### Response

    HTTP/1.1 200 OK
    Date: Thu, 24 Feb 2011 12:36:30 GMT
    Status: 201 Created
    Connection: close
    Content-Type: application/json
    Location: /thing/1
    Content-Length: 36

    {"message": "deleted"}

## Para processar a fila e executar o envio dos emails execute no terminal
- sail artisan queue:work
+ Para recebimento e análise dos emails enviados foi utilizado um serviço como o [Mailtrap](https://mailtrap.io)
