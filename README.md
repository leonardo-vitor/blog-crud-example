# Blog CRUD Example

O projeto deste repositório consiste em demonstrar o uso de um CRUD com PHP puro, e para isso será utilizado como exemplo um blog, com as funcionalidades de criação de artigos, listagem, edição, exclusão e visualização.

Os pacotes utilizados serão:
- [coffecode/router](https://github.com/robsonvleite/router) | gerenciamento de rotas
- [coffecode/paginator](https://github.com/robsonvleite/paginator) | gerador de paginação
- [coffecode/datalayer](https://github.com/robsonvleite/datalayer) | conexão e controle de banco de dados
- [league/plates](https://github.com/thephpleague/plates) | gerenciamento de views
- [league/plates](https://github.com/thephpleague/plates) | gerenciamento de views

## Instalação do projeto
Baixe o projeto e em um servidor local ou em uma hospedagem siga os seguintes passos:

1. Verifique se a versão do ***PHP é >= 8.0***
2. Verifique as extensões ***pdo*** e ***mbstring***, estão habilitadas.
3. Copie e cole o arquivo  ***.env.example*** dentro da pasta raiz do projeto e defina as variáveis de ambiente:

|Váriavel de ambiente| Descrição | Valores de exemplo|
|--|--|-|
|URL_DOMAIN |url de onde o sistema está hospedado ||
|DB_DRIVER| Driver de conexão com o banco de dados |mysql, pgsql|
|DB_NAME| Nome do banco de dados ||
|DB_HOST| Host do banco de dados ||
|DB_USER| Usuário do banco de dados ||
|DB_PASS| Senha do banco de dados |Deixar em branco caso não haja uma senha para conexão com o banco de dados |
|DB_PORT| Porta de acesso ao banco de dados ||

4. Execute o seguinte script sql dentro do banco de dados:
```
CREATE TABLE articles (
	id SERIAL PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	uri VARCHAR(255) NOT NULL,
	content TEXT NOT NULL,
	author VARCHAR(255) NOT NULL,
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP NULL
);
```

5. Execute o seguinte comando para instalar as dependecias do projeto:
```
composer install
```

## Demo do projeto
Para visualizar a demo do projeto, acesse: (https:)