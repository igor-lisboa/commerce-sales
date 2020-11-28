# Para rodar o projeto voce precisa ter:
* [composer](https://getcomposer.org/)
* [php](https://www.php.net/)
* [mysql](https://www.mysql.com/) OU [postgres](https://www.postgresql.org/)

# Para iniciar o projeto
* crie .env a partir de .env.example
```sh
cp .env.example .env
```
* instale as dependências do composer
```sh
composer install
```
* verifique as credenciais de acesso ao banco de dados usada e rode o comando abaixo
```sh
php artisan migrate:fresh --seed
```
* rode o comando abaixo para poder acessar o sistema
```sh
php artisan serve
```
