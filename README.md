# Carspotted

Web application to share photos of exotic cars.

[![CircleCI](https://circleci.com/gh/GSadee/Carspotted.svg?style=shield&circle-token=91ac786e9963de2e4b9699032829887df1af83dc)](https://circleci.com/gh/GSadee/Carspotted)
[![TravisCI](https://travis-ci.com/GSadee/Carspotted.svg?token=Fb9TazHQiTMgSpZsJ5Km&branch=master)](https://travis-ci.com/GSadee/Carspotted)

## Requirements

* ``PHP 7.0 or higher``
* ``Composer``
* ``Bower (NodeJS)``

## Installation

Run the following commands:

``` bash
$ brew install node
$ npm install -g bower
$ bower install

$ wget http://getcomposer.org/composer.phar
$ php composer.phar install
```

## Database

Run the following commands:

``` bash
$ app/console doctrine:database:create
$ app/console doctrine:schema:create
```

## Fixtures

Run the following commands:

``` bash
$ app/console hautelook_alice:doctrine:fixtures:load
```


## PHP Server

Run the following commands:

``` bash
$ app/console server:run
```
