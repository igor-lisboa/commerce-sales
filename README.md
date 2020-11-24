# Para rodar o projeto voce precisa ter:
* [composer](https://getcomposer.org/)
* [php](https://www.php.net/)
* [mysql](https://www.mysql.com/) OU [postgres](https://www.postgresql.org/)

# Para iniciar o projeto
* crie .env a partir de .env.example
```sh
cp .env.example .env
```
* verifique as credenciais de acesso ao banco de dados usada e rode o comando abaixo
```sh
php artisan migrate:fresh --seed
```
* rode o comando abaixo para poder acessar o sistema
```sh
php artisan serve
```

# Comandos executados para desenvolver o projeto
* composer global require laravel/installer
* laravel new commerceSales
* php artisan make:controller UserController --resource --model=User
* php artisan make:request UserAuth
* php artisan make:model Manager -m
* php artisan make:controller ManagerController --resource --model=Manager
* php artisan make:request Manager
* php artisan make:seeder UserSeeder
* php artisan make:seeder ManagerSeeder
* php artisan vendor:publish --tag=laravel-pagination
* php artisan make:request UserUpdateRequest
* php artisan make:mail ChangePassword
* php artisan make:event RequestPasswordChange
* php artisan make:listener SendMailRequestChangePassword -e RequestPasswordChange
* php artisan make:request UserUpdatePassword
* php artisan make:model Product -m
* php artisan make:controller ProductController --resource --model=Product
* php artisan make:factory ProductFactory --model=Product
* php artisan make:model ProductStock -m
* php artisan make:seeder ProductStockSeeder
* php artisan make:request Product
* php artisan make:request ProductStock
* php artisan make:model Client -m
* php artisan make:controller ClientController --resource --model=Client
* php artisan make:request Client
* php artisan session:table
* php artisan make:model Session
* php artisan make:model Complaint -m
* php artisan make:controller ComplaintController --resource --model=Complaint
* php artisan make:request Complaint
* php artisan make:factory ClientFactory --model=Client
* php artisan make:model Sale -m
* php artisan make:controller SaleController --resource --model=Sale
* php artisan make:model PaymentMethod -m
* php artisan make:seeder PaymentMethodSeeder
* php artisan make:model SaleProduct -m
* php artisan make:request SaleCreate
* php artisan make:controller SaleProductController --resource --model=SaleProduct
* php artisan make:request SaleProduct
* php artisan make:request SaleSetPaymentMethod