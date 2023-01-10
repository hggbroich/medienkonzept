# Medienkonzept Website

## Voraussetzungen

* PHP 8.1+
* MariaDB 10.4+

## Installation

```bash
$ git clone https://github.com/hggbroich/medienkonzept.git
$ composer install --no-dev --optimize-autoloader
$ php bin/console app:create-certificate --type saml
```

Nun die Informationen des Identity Providers unter `saml/idp.xml` ablegen.

```bash
$ php bin/console cache:clear
$ php bin/console doctrine:migrations:migrate --no-interaction
```

