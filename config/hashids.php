<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt' => 'pancord-salt-string',
            'length' => '11',
        ],

        'alternative' => [
            'salt' => 'your-salt-pancord',
            'length' => '11',
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz'
        ],

        'model' => [
            'salt' => 'pancord-model-string',
            'length' => '6',
            'alphabet' => 'abcdefg1234567890'
        ],

        'project' => [
            'salt' => 'pancord-project-string',
            'length' => '6',
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],

        'audioslide' => [
            'salt' => 'pancord-audioslide-string',
            'length' => '6',
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],

        'channel' => [
            'salt' => 'pancord-channel-string',
            'length' => '6',
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],

        'user' => [
            'salt' => 'pancord-user-string',
            'length' => '6',
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],

        'admin' => [
            'salt' => 'pancord-admin-string',
            'length' => '6',
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],

        'team' => [
            'salt' => 'pancord-team-string',
            'length' => '6',
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],

        'page' => [
            'salt' => 'pancord-page-string',
            'length' => '9',
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],

    ],

];
