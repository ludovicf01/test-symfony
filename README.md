Test Symfony
===========

##Minimum requirements
Sur mon environnement de développent j'utilise:
> - MAMP 4.4.1
> - PHP 7.2.1
> - MYSQL 5.6.38

##Attention
Mes paramètre du fichier parameters.yml
```
parameters:
    database_host: 127.0.0.1
    database_port: 8889
    database_name: symfony
    database_user: root
    database_password: root
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: 7e4148d5a7a82251a534bb90d5082161df238c73
```
##Déploiement
```
$ git clone https://github.com/ludovicf01/test-symfony.git
$ cd test-symfony
$ composer install
$ php app/console doctrine:database:create
```