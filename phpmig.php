<?php

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$container = new Pimple();

$container['db.config'] = require CONFIG_PATH . '/database.php';
$container['db'] = $container->share(function($c) {
    $db = new Capsule;
    $db->addConnection($c['db.config']);
    $db->setAsGlobal();
    $db->bootEloquent();
    return $db;
});

$container['phpmig.adapter'] = $container->share(function($c) {
    return new Phpmig\Adapter\Illuminate\Database($c['db'], 'migrations');
});

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'migrations';
$container['phpmig.migrations_template_path'] = $container['phpmig.migrations_path'] . DIRECTORY_SEPARATOR . '.template.php';
return $container;