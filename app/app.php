<?php
	
	require_once __DIR__."/../vendor/autoload.php";
	
	use Symfony\Component\Debug\Debug;Debug::enable();
	
	use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

	$app = new Silex\Application();
	
	$app['debug'] = true;
	
	$server = 'mysql:host=localhost:8889;dbname=hair_salon';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);
	
	$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));
	
	$app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form_check' => false));

    });

    $app->get("/form_cuisine", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form_check' => true));

    });

    $app->post("/add_cuisine", function() use ($app) {
        $cuisine = new Cuisine($_POST['type']);
        $cuisine->save();

        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form_check' => false));

    });

    $app->post("/delete_stylists", function() use ($app) {
        Cuisine::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll(), 'form_check' => false));

    });

    $app->get("/stylists/{id}", function($id) use ($app) {
        $cuisine = Stylist::find($id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants(), 'form_check' => false));
    });

    $app->get("/form_restaurant", function() use ($app) {
        $cuisine = Stylist::find($_GET['cuisine_id']);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants(), 'form_check' => true));
    });

    $app->post("/add_restaurant", function() use ($app) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $website = $_POST['website'];
        $cuisine_id = $_POST['cuisine_id'];
        $restaurant = new Restaurant($name, $id = null, $phone, $address, $website, $cuisine_id);
        $restaurant->save();

        $cuisine = Stylist::find($cuisine_id);
        return $app['twig']->render('cuisine.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants(), 'form_check' => false));
    });

    $app->get("/restaurants/{id}", function($id) use ($app) {
        $restaurant = Client::find($id);
        $stylists = Stylist::getAll();
        return $app['twig']->render('restaurant.html.twig', array('restaurant' => $restaurant, 'form_check' => false, 'stylists' => $stylists));
    });

    $app->get("/form_restaurant_update", function() use ($app) {
        $restaurant = Client::find($_GET['restaurant_id']);
        $stylists = Stylist::getAll();
        return $app['twig']->render('restaurant.html.twig', array('restaurant' => $restaurant, 'form_check' => true, 'stylists' => $stylists));
    });

    $app->patch("/update_restaurant", function() use ($app) {
        $name = $_POST['name'];
        $restaurant_id = $_POST['restaurant_id'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $website = $_POST['website'];
        $cuisine_id = $_POST['cuisine_id'];
        $stylists = Stylist::getAll();

        $restaurant = Client::find($restaurant_id);
        $restaurant->update_restaurant($name, $restaurant_id, $phone, $address, $website, $cuisine_id);

        return $app['twig']->render('restaurant.html.twig', array('restaurant' => $restaurant, 'form_check' => false, 'stylists' => $stylists));
    });


    return $app;
?>