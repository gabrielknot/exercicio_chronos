# Desafio_Chronos | CRUD - Cliente
Projeto para criar, editar e remover clientes

##### Link para teste: https://desafio-chronos.000webhostapp.com/

Sumário
=================
<!--ts-->
   * [Como testar no pc](#Como-testar-no-pc)
        * [Requisitos](#Requisitos)
            * [Laragon](#Laragon)
   * [Laravel-Readme](#Implementações-de-Segurança)
<!--te-->


 #  Como testar no pc

 ## Requisitos
 
 ### Composer
 Link para a pagina dedowload: https://getcomposer.org/download/
 Link para dowload direto: https://getcomposer.org/Composer-Setup.exe
 
 ### Laragon
Link para Dowload https://laragon.org/download/index.html
Link direto para dowload direto da versão full: https://sourceforge.net/projects/laragon/files/releases/4.0/laragon-full.exe

### PHP
Link para Dowload do PHP 7.4.zip para windows https://windows.php.net/downloads/releases/php-7.4.16-Win32-vc15-x64.zip

## Dowload da aplicao
Clone o projeto para pasta www do laragon através do comando: git clone, ou baixando o arquivo zip do projeto e extrando para a pasta www do 
No pagina do projeto: https://github.com/lucasdantas2014/desafio_chronos

## Configurando Aplicacao
Instalando os programas acima citados e a pasta do projeto devidamente localizad:
1. Inicie o Laragon
2. execute o codigo abaixo para baixar as dependencias
3. composer install --no-scripts
4. Na pasta do projeto, copie e cole o arquivo .env.example e renomei a copia para .env
5. Abra o aquivo .env no editor de texto de sua preferência e coloque os dados do seu banco de dados
6. Exxecute o comando abaixo para criar uma nova chave para sua aplicacao 
7. Execute o comando abaixo para que as tabelas do banco de dados sejam criadas

## Inicie o servidor
Com o projeto devidamente configurado execute o comando:
php artisan serve

## Acessando a aplicacao
Por padrão o projeto será iniciado no seguinte link:
localhost:8000/public/

# Funcionalidades do sistema

## Testando
# Criar Cliente
# Editar Cliente
# Remover Cliente

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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
