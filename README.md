# Exercicio_Chronos | CRUD - Cliente
Projeto para criar, editar e remover clientes

##### Link para testar a aplicação online: https://desafio-chronos.000webhostapp.com/

Em caso de dúvidas, erros ou sugestões pode enviar um email para lucas.dantas0201@gmai.com

Sumário
=================
<!--ts-->
   * [Como testar no pc](#Como-testar-no-pc)
        * [Requisitos](#Requisitos)
            * [Laragon](#Laragon)
            * [PHP](#PHP)
            * [Composer](#Composer)
        * [Dowload da Aplicacao](#Dowload_da_Aplicacao)
        * [Configurando a Aplicação](#Configurando_a_Aplicação)   
        * [Iniciando o Servidor](#Inicie-o-Servidor)
        * [Acessando a Aplicação](#Acessando a Aplicação)
   * [Funcionalidades do Sistema](#Funcionalidades-do-Sistema)  
   * [Laravel-Readme](#Implementações-de-Segurança)
<!--te-->


 #  Como testar no pc

 ## Requisitos
 
 
 ### Laragon
Link para Dowload https://laragon.org/download/index.html
Link direto para dowload direto da versão full: https://sourceforge.net/projects/laragon/files/releases/4.0/laragon-full.exe

### PHP
Link para Dowload do PHP 7.4.zip para windows https://windows.php.net/downloads/releases/php-7.4.16-Win32-vc15-x64.zip

Mova o arquivo zip do PHP baixado para a pasta "C:/laragon/bin/php", conforme a imagem abaixo 
![dowload php](https://user-images.githubusercontent.com/21109930/113493693-2de7ee80-94b8-11eb-8d3b-a9eb164e9579.png)

Crie uma pasta com o mesmo nome do arquivo zip
![criar_pasta](https://user-images.githubusercontent.com/21109930/113493711-5243cb00-94b8-11eb-9f5a-6eb21e366539.png)

Extraia o arquivo zip baixado para a pasta criada
![extraindo php para o laravel](https://user-images.githubusercontent.com/21109930/113493721-6982b880-94b8-11eb-8457-cfdfc0d57b71.png)

Agora, vá no laragon e selecione a versão do PHP 7.4: Clique com o botão direito no laragon, vá em PHP e selecione a versão como na imagem abaixo:
![selecionando a versao do php no laragon](https://user-images.githubusercontent.com/21109930/113493751-acdd2700-94b8-11eb-8fb7-b3944530cdab.png)


### Composer
Link para a pagina de dowload: https://getcomposer.org/download/
Link para dowload direto: https://getcomposer.org/Composer-Setup.exe

Atente para que no momento de seleciona o PHP, selecione o php.exe do PHP 7.4 que foi adicionado no laragon, observe a imagem abaixo:
![composer select php](https://user-images.githubusercontent.com/21109930/113493782-eb72e180-94b8-11eb-9fee-1f9a07699f0b.png)
![php selecionado composer](https://user-images.githubusercontent.com/21109930/113493786-f299ef80-94b8-11eb-87f1-8cf898cb3dbf.png)

## Dowload da Aplicação
Clone o projeto para pasta www do laragon através do comando: git clone, ou baixando o arquivo zip do projeto e extraindo para a pasta www do 
No pagina do projeto: https://github.com/lucasdantas2014/desafio_chronos
![dowload_do_projeto_no_git](https://user-images.githubusercontent.com/21109930/113493820-355bc780-94b9-11eb-8313-6eb4d53898c8.png)
![Extraindo projeto para o laragon](https://user-images.githubusercontent.com/21109930/113493807-1f4e0700-94b9-11eb-9112-319ab5beaafb.png)


## Configurando Aplicacao
Instalando os programas a cima citados e a pasta do projeto devidamente localizada:

1. Inicie o Laragon

![iniciar laragon](https://user-images.githubusercontent.com/21109930/113493846-9a172200-94b9-11eb-9c03-616e756132bf.png)

2. Entre no terminal do laragon  
![acessando terminal](https://user-images.githubusercontent.com/21109930/113493994-c41d1400-94ba-11eb-8de8-c5169c1d02a5.png)

3. Acesse a página do projeto

![acesse_a_pasta_do_projeto](https://user-images.githubusercontent.com/21109930/113494003-d39c5d00-94ba-11eb-9552-e860bd1b1031.png)

4. execute o código abaixo para baixar as dependências

![composer_install](https://user-images.githubusercontent.com/21109930/113493938-625caa00-94ba-11eb-9c14-28873e37bbec.png)

5. Na pasta do projeto, copie e cole o arquivo .env.example e renomei a copia para .env

![crei o arquivo env no projeto](https://user-images.githubusercontent.com/21109930/113494013-eb73e100-94ba-11eb-99f9-66e7f5d0227d.png)

6. Crie um banco de dados
    6.1 Acesse o database do laragon

![acessando database](https://user-images.githubusercontent.com/21109930/113494066-6a691980-94bb-11eb-8ca6-0418f3e2d4eb.png)

    6.2 Abra o sistema para gerenciar o banco de dados

![acessando database abrir](https://user-images.githubusercontent.com/21109930/113494085-997f8b00-94bb-11eb-8bdf-713ad63e229d.png)

OBS: Caso você já tenha um SGBD instalado e configurado na sua maquina, você pode colocar o nome de usuario e senha do seu SGBD

    6.3 Crie um banco de dados

![selecionando a versao do php no laragon](https://user-images.githubusercontent.com/21109930/113494113-d77caf00-94bb-11eb-943c-9c4c8f300fe4.png)

7. Abra o aquivo .env no editor de texto de sua preferência e coloque os dados do seu banco de dados 

![dados para serem ajustados](https://user-images.githubusercontent.com/21109930/113494043-2d048c00-94bb-11eb-92f3-4dc892ff551a.png)

8. Execute o comando abaixo para criar uma nova chave para sua aplicação 

![gerar_key](https://user-images.githubusercontent.com/21109930/113494156-17439680-94bc-11eb-80c8-0621a7b81e7f.png)

9. Execute o comando abaixo para que as tabelas do banco de dados sejam criadas

![php_migrate](https://user-images.githubusercontent.com/21109930/113494185-64276d00-94bc-11eb-9c1c-dc864bbd51de.png)


## Iniciando o Servidor
Com o projeto devidamente configurado execute o comando: php artisan serve

![php_serve](https://user-images.githubusercontent.com/21109930/113494187-71dcf280-94bc-11eb-837b-4e6b1dbae8c0.png)


## Acessando a aplicacao
Por padrão o projeto será iniciado no seguinte link:
localhost:8000/desafio_chronos-main/public/
![link](https://user-images.githubusercontent.com/21109930/113494265-1d864280-94bd-11eb-8927-6cdf00b5ed73.png)

# Funcionalidades do sistema
### Ver Clientes
![lista_de_clientes](https://user-images.githubusercontent.com/21109930/113494373-fed47b80-94bd-11eb-85a5-2074c87f90cc.png)

### Criar Cliente
![cadastrar_cliente](https://user-images.githubusercontent.com/21109930/113494380-0a27a700-94be-11eb-9101-3952f6a1138b.png)
![tela_cadastro](https://user-images.githubusercontent.com/21109930/113494432-802c0e00-94be-11eb-8350-4a754423e83c.png)

### Editar Cliente
![editar_cliente](https://user-images.githubusercontent.com/21109930/113494387-1c094a00-94be-11eb-87e6-f09be0205647.png)
![tela_edicao](https://user-images.githubusercontent.com/21109930/113494444-8e7a2a00-94be-11eb-8103-80264d0cda1a.png)

### Remover Cliente
![remover_cliente](https://user-images.githubusercontent.com/21109930/113494390-27f50c00-94be-11eb-95b9-c36dd355415e.png)


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and Jav
