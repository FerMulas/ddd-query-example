<?php
chdir(dirname(__DIR__));

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

require __DIR__ . '/../../../../../../../vendor/autoload.php';

(function () {
    /** @var \Interop\Container\ContainerInterface $container */
    $container = require __DIR__ . '/../../../../Di/ServiceManager/config/container.php';

    /** @var \Zend\Expressive\Application $app */
    $app = $container->get(\Zend\Expressive\Application::class);

    (require __DIR__ . '/../../../../Di/ServiceManager/config/pipeline.php')($app);
    (require __DIR__ . '/../../../../Di/ServiceManager/config/routes.php')($app);

    $app->run();
})();