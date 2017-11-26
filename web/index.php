<?php

require_once __DIR__.'/../vendor/autoload.php';

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/App/Resources/views',
));

/**
 * Route for doc
 **/
$app->get('/', function() use($app) {
	return $app['twig']->render('index.html.twig');
});

/**
 * Routes for ad management	
 **/
$app->mount('/ad', new App\AdControllerProvider());

$app->run();