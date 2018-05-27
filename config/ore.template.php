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
    	'application/pdf' => "Railken\LaraOre\Template\Generators\PdfGenerator"
    ]
];
