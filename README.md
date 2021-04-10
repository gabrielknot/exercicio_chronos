# Exercicio_Chronos | CRUD - Cliente
Projeto para criar, editar e remover clientes

## Link para testar a aplicação online: 
https://desafio-chronos.000webhostapp.com/

Em caso de dúvidas, erros ou sugestões pode enviar um email para lucas.dantas0201@gmai.com

Sumário
=================
<!--ts-->
   * [Como testar online](#Como-testar-no-pc)
   * [Como testar no pc](#Como-testar-no-pc)
        * [Requisitos](#Requisitos)
            * [Laragon](#Laragon)
            * [PHP](#PHP)
            * [Composer](#Composer)
        * [Dowload da Aplicacao](#Dowload-da-Aplicacao)
        * [Configurando a Aplicação](#Configurando-a-Aplicação)   
        * [Iniciando o Servidor](#Iniciando-o-Servidor)
        * [Acessando a Aplicação](#Acessando-a-Aplicação)
   * [Funcionalidades do Sistema](#Funcionalidades-do-Sistema)  
   * [Laravel-Readme](#Laravel-Readme)
<!--te-->

 #  Como testar Online
 
 A aplicação está hospedada online para ser vizualisada e testada, só é necessário acessar o seguinte link: https://desafio-chronos.000webhostapp.com/

 #  Como testar no pc de forma local

<strong>OBS: Esse tutorial foi desenvolvido para testes em computadores com arquitetura 64 bits (principalmente os links diretos), para computadores 32 bits será necessário baixar versões compátiveis dos softwares requisitados. </strong>
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

Atente para que no momento de seleciona o PHP, selecione o php.exe do PHP 7.4 que foi adicionado no laragon (por padrão o caminho para a pesta será "C:\laragon\bin\php\php-7.4.16-Win32-vc-x64\php.exe", observe a imagem abaixo:
![composer select php](https://user-images.githubusercontent.com/21109930/113525694-c6e83980-958c-11eb-943e-92fba6676245.png)
![php selecionado composer](https://user-images.githubusercontent.com/21109930/113493786-f299ef80-94b8-11eb-87f1-8cf898cb3dbf.png)

## Dowload da Aplicação <a name="Dowload-da-Aplicacao"></a>
Baixe o projeto em arquivo zip do projeto e extraia para a pasta www do laragon, como nas imagens abaixo

![dowload_projeto](https://user-images.githubusercontent.com/21109930/114237310-4abd6f80-9959-11eb-8990-1f7a81abff81.png)
![extraindo projeto](https://user-images.githubusercontent.com/21109930/113525983-6528cf00-958e-11eb-8301-63c5bce82233.png)


## Configurando Aplicacao <a name="Configurando-a-Aplicação"></a>
Instalando os programas a cima citados e a pasta do projeto devidamente localizada:

<strong> 1. Inicie o Laragon </strong>

![iniciar laragon](https://user-images.githubusercontent.com/21109930/113526711-72938880-9591-11eb-9101-c2ff81f59d77.png)

<strong> 2. Entre no terminal do laragon </strong>

![acessando terminal](https://user-images.githubusercontent.com/21109930/113493994-c41d1400-94ba-11eb-8de8-c5169c1d02a5.png)

<strong> 3. No terminal, acesse a página do projeto </strong>
    
    cd exercicio-chronos-main
    
<br/>

![acessando pasta](https://user-images.githubusercontent.com/21109930/113527453-f9e1fb80-9593-11eb-968a-aa2ac3357713.png)

<strong> 4. execute o código abaixo para baixar as dependências </strong>

    composer install --no-scripts

<strong> 5. Crie um banco de dados </strong>

5.1 Acesse o database do laragon 

![acessando database](https://user-images.githubusercontent.com/21109930/113494066-6a691980-94bb-11eb-8ca6-0418f3e2d4eb.png)

5.2 Abra o sistema para gerenciar o banco de dados

![acessando database abrir](https://user-images.githubusercontent.com/21109930/113494085-997f8b00-94bb-11eb-8bdf-713ad63e229d.png)

OBS: Caso você já tenha um SGBD instalado e configurado na sua maquina, você pode colocar o nome de usuario e senha do seu SGBD


5.3 Crie um banco de dados

![criando banco de dados](https://user-images.githubusercontent.com/21109930/113527883-5265c880-9595-11eb-8333-117799d535ea.png)

Insira um nome para o banco de dados da aplicação (exemplo: exercicio_chronos):

![inserindo nome para o banco de dados](https://user-images.githubusercontent.com/21109930/113528228-5e9e5580-9596-11eb-8d7c-95a8305f1571.png)


<strong> 6. Na pasta do projeto, copie e cole o arquivo .env.example e renomei a copia para .env </strong>

![arquivo env](https://user-images.githubusercontent.com/21109930/113526333-0f552680-9590-11eb-904a-ee7519265809.png)

<strong> 7. Abra o aquivo .env no editor de texto de sua preferência e coloque os dados do seu banco de dados </strong>

![informacoes banco de dados](https://user-images.githubusercontent.com/21109930/113526297-ee8cd100-958f-11eb-9b08-63e7f123a34c.png)

<strong> 8. Novamente no terminal, execute o comando abaixo para criar uma nova chave para sua aplicação </strong>

    php artisan key:generate    

<strong> 9. Execute o comando abaixo para que as tabelas do banco de dados sejam criadas</strong>

    php artisan migrate
    
## Iniciando o Servidor <a name="Iniciando-o-Servidor"></a>
Com o projeto devidamente configurado execute o comando: php artisan serve

    php artisan serve


## Acessando a Aplicacao <a name="Acessando-a-Aplicação"></a>
Por padrão o projeto será iniciado no seguinte link:
localhost:8000/exercicio_chronos-main/public/![criando banco de dados](https://user-images.githubusercontent.com/21109930/113527804-129ee100-9595-11eb-9f04-26c330fdbf1f.png)


![link padrao na maquina](https://user-images.githubusercontent.com/21109930/113526858-fa799280-9591-11eb-93df-81ac92902ed1.png)

# Funcionalidades do sistema <a name="Funcionalidades-do-Sistema"></a>
### Ver Clientes
![tela lista de clientes](https://user-images.githubusercontent.com/21109930/113527116-e1bdac80-9592-11eb-8a30-7c2abd41540e.png)


### Criar Cliente
![adicionar cliente](https://user-images.githubusercontent.com/21109930/113527136-f5691300-9592-11eb-9ecf-f484d236db74.png)
![tela adicionar cliente](https://user-images.githubusercontent.com/21109930/113527143-fbf78a80-9592-11eb-85bf-8cf0d0ccca94.png)


### Editar Cliente
![editar cliente](https://user-images.githubusercontent.com/21109930/113527198-1fbad080-9593-11eb-90eb-efc3de6a233e.png)
![tela editar cliente](https://user-images.githubusercontent.com/21109930/113527341-9f489f80-9593-11eb-872f-e5fc87116e76.png)


### Remover Cliente
![remover clietne](https://user-images.githubusercontent.com/21109930/113527348-a8397100-9593-11eb-8877-9533bcc5c123.png)



<a name="Laravel-Readme"></a>
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
