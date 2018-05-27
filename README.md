# lara-ore-template

[![Build Status](https://travis-ci.org/railken/lara-ore-template.svg?branch=master)](https://travis-ci.org/railken/lara-ore-template)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

A laravel package to create templates: .html, .xls, .csv, .pdf
# Requirements

PHP 7.1.0 and later.


## Installation

You can install it via [Composer](https://getcomposer.org/) by typing the following command:

```bash
composer require railken/lara-ore-template
```

The package will automatically register itself.

You can publish the migration with:

```bash
php artisan vendor:publish --provider="Railken\LaraOre\Template\TemplateServiceProvider" --tag="migrations"
```

After the migration has been published you can create the media-table by running the migrations:

```bash
php artisan migrate
```
You can publish the config-file with:

```bash
php artisan vendor:publish --provider="Railken\LaraOre\Template\TemplateServiceProvide" --tag="config"
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
    'table' => 'ore_templatesf',
];
```
