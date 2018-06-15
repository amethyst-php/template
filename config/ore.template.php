<?php

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

    /*
    |--------------------------------------------------------------------------
    | File Generators
    |--------------------------------------------------------------------------
    |
    | File generators
    |
    */
    'generators' => [
        'application/pdf' => "Railken\LaraOre\Template\Generators\PdfGenerator",
        'text/html'       => "Railken\LaraOre\Template\Generators\HtmlGenerator",
        'text/plain'      => "Railken\LaraOre\Template\Generators\TextGenerator",
        'application/xls' => "Railken\LaraOre\Template\Generators\ExcelGenerator",
    ],

    'router' => [
        'prefix' => '/admin/templates',
        'middlewares' => [
            \Railken\LaraOre\RequestLoggerMiddleware::class,
            'auth:api',
        ],
    ],
];
