# lara-ore-template

[![Build Status](https://img.shields.io/travis/railken/lara-ore-template/master.svg?style=flat-square)](https://travis-ci.org/railken/lara-ore-template)
[![StyleCI](https://github.styleci.io/repos/135063291/shield?branch=master)](https://github.styleci.io/repos/135063291)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

A laravel package to create templates: .html, .xls, .csv, .pdf
# Requirements

PHP 7.1 and later.


## Installation

You can install it via [Composer](https://getcomposer.org/) by typing the following command:

```bash
composer require railken/lara-ore-template
```

The package will automatically register itself.

You can publish the migration with:

```bash
php artisan vendor:publish --provider="Railken\LaraOre\TemplateServiceProvider" --tag="migrations"
```

After the migration has been published you can create the media-table by running the migrations:

```bash
php artisan migrate
```
You can publish the config-file with:

```bash
php artisan vendor:publish --provider="Railken\LaraOre\TemplateServiceProvide" --tag="config"
```

## Configuration
```php

return [

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    |
    | This is the table used to save templates to the database
    |
    */
    'table' => 'ore_templates',
];
```
