<?php

use Bramus\Router\Router;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require '../vendor/autoload.php';

$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

$router = new Router();

require_once '../routes.php';

$router->run();