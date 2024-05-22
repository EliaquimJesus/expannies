<?php

declare(strict_types=1);

namespace App;

class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host'      => $env['DB_HOST'],
                'dbname'  => $env['DB_DATABASE'],
                'user'  => $env['DB_USER'],
                'password'  => $env['DB_PASS'],
                'driver'    => $env['DB_DRIVER'] ?? 'pdo_mysql',
                // 'charset'   => 'utf8',
                // 'collation' => 'utf8_unicode_ci',
                // 'prefix'    => '',
            ],
            'apiKeys' => [
                'emailable' => $env['EMAILABLE_API_KEY'] ?? ''
            ],
            'mailer' => [
                'dsn' => $env['MAILER_DSN']
            ]
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}
