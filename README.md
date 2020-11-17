# Comandos executados
* composer global require laravel/installer
* laravel new commerceSales
* php artisan make:controller UserController --resource --model=User
* php artisan make:request UserAuth

# Para rodar o projeto voce precisa ter:
* [composer](https://getcomposer.org/)
* [php](https://www.php.net/)
* [mysql](https://www.mysql.com/)

# Para iniciar o projeto
* crie .env a partir de .env.example
```sh
cp .env.example .env
```
* verifique as credenciais de acesso ao banco de dados usada e rode o comando abaixo
```sh
php artisan migrate:fresh
```
* rode o comando abaixo para poder acessar o sistema
```sh
php artisan serve
```