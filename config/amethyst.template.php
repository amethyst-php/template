<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Managers
    |--------------------------------------------------------------------------
    |
    | Here you can change the table name and the class components
    | used by each manager.
    |
    */
    'managers' => [
        'template' => [
            /*
            |--------------------------------------------------------------------------
            | Table Name
            |--------------------------------------------------------------------------
            |
            | This is the table name used while interacting with the database
            |
            */
            'table' => 'amethyst_templates',

            /*
            |--------------------------------------------------------------------------
            | Class Entity
            |--------------------------------------------------------------------------
            |
            | The class of the model used by the manager.
            | Change this if you have to add more relations or custom logic.
            |
            */
            'model' => Railken\Amethyst\Models\Template::class,

            /*
            |--------------------------------------------------------------------------
            | Class Schema
            |--------------------------------------------------------------------------
            |
            | The class of the schema used by the manager.
            | Change this if you want to update the attributes.
            */
            'schema' => Railken\Amethyst\Schemas\TemplateSchema::class,

            /*
            |--------------------------------------------------------------------------
            | Class Repository
            |--------------------------------------------------------------------------
            |
            | The class of the repository used to perform all queries.
            | Change this if you have to add more complex queries (e.g. ::findOneBy).
            |
            */
            'repository' => Railken\Amethyst\Repositories\TemplateRepository::class,

            /*
            |--------------------------------------------------------------------------
            | Class Serializer
            |--------------------------------------------------------------------------
            |
            | The class of the serializer used to serialize the model.
            | Change this if you have to add more data while serializing.
            |
            */
            'serializer' => Railken\Amethyst\Serializers\TemplateSerializer::class,

            /*
            |--------------------------------------------------------------------------
            | Class Validator
            |--------------------------------------------------------------------------
            |
            | The class of the validator used to validate the parameters.
            | Change this if you have to add more complex validation.
            | A validation handled by the single attributes is always preferred to this.
            |
            */
            'validator' => Railken\Amethyst\Validators\TemplateValidator::class,

            /*
            |--------------------------------------------------------------------------
            | Class Authorizer
            |--------------------------------------------------------------------------
            |
            | The class of the authorizer used to authorize the user.
            | Change this if you have to add more complex authorization.
            |
            */
            'authorizer' => Railken\Amethyst\Authorizers\TemplateAuthorizer::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Http configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the routes
    |
    */
    'http' => [
        'admin' => [
            'template' => [
                'enabled'     => true,
                'controller'  => Railken\Amethyst\Http\Controllers\Admin\TemplatesController::class,
                'router'      => [
                    'as'        => 'template.',
                    'prefix'    => '/templates',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | File Generators
    |--------------------------------------------------------------------------
    |
    | File generators
    |
    */
    'generators' => [
        'application/pdf' => Railken\Template\Generators\PdfGenerator::class,
        'text/html'       => Railken\Template\Generators\HtmlGenerator::class,
        'text/plain'      => Railken\Template\Generators\TextGenerator::class,
        'application/xls' => Railken\Template\Generators\ExcelGenerator::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Views folder
    |--------------------------------------------------------------------------
    |
    | The folder where the view templates will be saved
    |
    */
    'views' => '/amethyst-template/views',

    /*
    |--------------------------------------------------------------------------
    | Cache folder
    |--------------------------------------------------------------------------
    |
    | The cache folder
    |
    */
    'cache' => '/amethyst-template/cache',
];
