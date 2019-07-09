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
            'model'      => Amethyst\Models\Template::class,
            'schema'     => Amethyst\Schemas\TemplateSchema::class,
            'repository' => Amethyst\Repositories\TemplateRepository::class,
            'serializer' => Amethyst\Serializers\TemplateSerializer::class,
            'validator'  => Amethyst\Validators\TemplateValidator::class,
            'authorizer' => Amethyst\Authorizers\TemplateAuthorizer::class,
            'faker'      => Amethyst\Fakers\TemplateFaker::class,
            'manager'    => Amethyst\Managers\TemplateManager::class,
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
                'enabled'    => true,
                'controller' => Amethyst\Http\Controllers\Admin\TemplatesController::class,
                'router'     => [
                    'as'     => 'template.',
                    'prefix' => '/templates',
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
