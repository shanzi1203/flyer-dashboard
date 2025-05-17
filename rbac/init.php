<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// Include the correct config files
$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../common/config/main.php',
    require __DIR__ . '/../common/config/main-local.php',
    require __DIR__ . '/../console/config/main.php'
);

$app = new yii\console\Application($config);

$auth = Yii::$app->authManager;

// Clear existing RBAC data
$auth->removeAll();

// Create roles
$admin = $auth->createRole('admin');
$auth->add($admin);

$client = $auth->createRole('client');
$auth->add($client);

echo " RBAC roles 'admin' and 'client' created.\n";
