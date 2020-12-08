## Como usar este projeto

### Pré requisitos:
- docker e docker-compose
- npm v6.14.8

### Configurando o ambiente

Primeiro ter nosso próprio arquivo .env:

```bash
$ cp .env.example .env
```

Em seguida devemos aleterar as configurações de banco de dados, para isso abra o arquivo .env e altere as credenciais:

```dotenv
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=next_teste
DB_USERNAME=next
DB_PASSWORD=next123
```
 
Em seguida é necessário fazer o build do arquivo ```docker-compose.yml```

```bash
$ docker-compose build
```

Depois podemos inicializar os containers em modo daemon:

```bash
$ docker-compose up -d
```

Após os containers terem sidos inicializados iremos instalar nossa aplicação:

```bash
$ docker-compose exec app composer install
```

Agora geraremos uma chave para o nosso projeto:

```bash
$ docker-compose exec app php artisan key:generate
```

Em seguida subiremos nossas migrates:

```bash
$ docker-compose exec app php artisan migrate
```

Pronto, nosso ambiente back-end ja esta configurado! Agora vamos para o front-end.


Com a versão 6.14.8 do npm instalaremos nossas dependências:

```bash
$ npm install
```

Depois de nossas dependências terem sido devidamente instaladas, vamos gerar nossas views:

```bash
$ npm run prod
```

E pronto, ja podemos acessar nossa aplicação pelo link http://localhost:8000!
