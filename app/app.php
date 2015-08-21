<?php
	
	require_once __DIR__."/../vendor/autoload.php";
	
	use Symfony\Component\Debug\Debug;Debug::enable();
	
	use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

	$app = new Silex\Application();
	
	$app['debug'] = true;
	
	$server = 'mysql:host=localhost:8889;dbname=restaurant_cuisine';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);
	
	$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));
	
	$app->get("/", function() use ($app) {
    //  Add route information here
	});
	
	return $app;
	
?>