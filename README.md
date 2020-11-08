# [TCC00338 - PROJETO DE SOFTWARE - A1 | Trabalho Final](https://classroom.google.com/u/1/c/MTIxMTY2OTI0MTkw/a/MTUwMzAyNzIyNDQ5/details)

## Passo a passo do projeto
* Instalação do Laravel
```sh
composer global require laravel/installer
```
* Inicialização do novo projeto
```sh
laravel new commerce-sales --jet --teams
```
* Incluindo model com migrate de Clientes
```sh
php artisan make:model Client -m
```
* Incluindo model com migrate de Gerentes
```sh
php artisan make:model Managers -m
```
* Incluindo model com migrate de Vendedores(Caixas)
```sh
php artisan make:model Cashiers -m
```
* Incluindo model com migrate de Tipos de Pagamento
```sh
php artisan make:model PaymentType -m
```
* Incluindo model com migrate de Vendas
```sh
php artisan make:model Sale -m
```
* Incluindo model com migrate de Produtos
```sh
php artisan make:model Product -m
```
* Incluindo model com migrate de Produtos da Venda
```sh
php artisan make:model SaleProduct -m
```
* Incluindo model com migrate do Envio de Promoções
```sh
php artisan make:model PromotionSend -m
```
* Incluindo model com migrate da Troca de Produtos
```sh
php artisan make:model ProductExchange -m
```
* Incluindo model com migrate de Reclamações
```sh
php artisan make:model Claim -m
```