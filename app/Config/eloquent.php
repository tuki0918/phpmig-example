<?php

use Illuminate\Database\Capsule\Manager as DB;

$config = require CONFIG_PATH . '/database.php';

$db = new DB;
$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();
