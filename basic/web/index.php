<?php
header('Content-Type: text/html; charset=utf-8');
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../externalClasses/vsword/VsWord.php');
require_once(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require_once(__DIR__ . '/../helpers/AppHelper.php');
require_once(__DIR__ . '/../modules/auth/autoload.php');


$config = require_once(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();

