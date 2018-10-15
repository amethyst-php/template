<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    |
    | Here you can change the table name and the class components-
    |
    */
    'data' => [
        'template' => [
            'table'      => 'amethyst_templates',
            'comment'    => 'Template',
            'model'      => Railken\Amethyst\Models\Template::class,
            'schema'     => Railken\Amethyst\Schemas\TemplateSchema::class,
            'repository' => Railken\Amethyst\Repositories\TemplateRepository::class,
            'serializer' => Railken\Amethyst\Serializers\TemplateSerializer::class,
            'validator'  => Railken\Amethyst\Validators\TemplateValidator::class,
            'authorizer' => Railken\Amethyst\Authorizers\TemplateAuthorizer::class,
            'faker'      => Railken\Amethyst\Fakers\TemplateFaker::class,
            'manager'    => Railken\Amethyst\Managers\TemplateManager::class,
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
