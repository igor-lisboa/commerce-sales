# Documentos do projeto
* Estão na pasta [/arquivos_trabalho](https://github.com/igor-lisboa/commerce-sales/tree/main/arquivos_trabalho)
* Mas também podem ser encontrados no [Google Drive](https://drive.google.com/drive/folders/1VbdfnAtDPqReQlx2Qnu7xCf6Et_zDrnx?usp=sharing)

# O documento do trabalho final de Projeto de Software pode ser encontrado em:
* [https://github.com/igor-lisboa/commerce-sales/blob/main/arquivos_trabalho/Trabalho%20Final%20PS.pdf](https://github.com/igor-lisboa/commerce-sales/blob/main/arquivos_trabalho/Trabalho%20Final%20PS.pdf)

# O deploy do trabalho feito no heroku
* [commercesales.herokuapp.com](http://commercesales.herokuapp.com)

## Deixamos 2 Logins para o uso do professor
### Nome: Professor (Caixa)
* E-Mail: prof_caixa@example.com
* Senha: 12345

### Nome: Professor (Gerente)
* E-Mail: prof_gerente@example.com
* Senha: 12345


# Os integrantes do grupo são:
- [Caio Wey Barros - 117083065](https://github.com/caiowbarros)
- [Gabriel Sena Oddone - 216083091](https://github.com/gabrielodd)
- [Igor Rodrigues Lisboa - 117083069](https://github.com/igor-lisboa)
- [Luiz Gustavo Pereira - 818031066](https://github.com/LuizGPereira)
- [Mariana Suarez de Oliveira - 217031112](https://github.com/marizeraus)
- [Rafael Franca Scofield Lauar - 217083126](https://github.com/Rafa2266)
- [Vitor Marreiro Azevedo Cuzzuol - 215083117](https://github.com/vitorcuzzuol)

# Para rodar o projeto voce precisa ter:
* [composer](https://getcomposer.org/)
* [php](https://www.php.net/)
* [mysql](https://www.mysql.com/) OU [postgres](https://www.postgresql.org/)

# Para iniciar o projeto em sua máquina:
1. crie .env a partir de .env.example
```sh
cp .env.example .env
```
2. instale as dependências do composer
```sh
composer install
```
3. verifique as credenciais de acesso ao banco de dados usada e rode o comando abaixo
```sh
php artisan migrate:fresh --seed
```
4. rode o comando abaixo para poder acessar o sistema
```sh
php artisan serve
```
5. rode o comando abaixo para iniciar o schedule que enviará o email para os clientes preferênciais a cada 2 meses
```sh
php artisan schedule:work
```
