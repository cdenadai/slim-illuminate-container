<?php

use App\Http\Controllers\PersonController;

/**
 * Illuminate/Container is a powerful inversion of control container,
 * which can easily be used independent of Laravel to help manage
 * class dependencies. In addition to basic class binding, it
 * also supports automatic resolution, which resolves classes
 * without any configuration required.
 *
 * Requires: illuminate/container
 *
 * @source https://github.com/illuminate/container
 * @contributor https://github.com/reinink
 */


$container = require_once __DIR__."/Apps/bootstrap/app.php";

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

$app = new \Slim\App(['settings' => ['debug' => true, 'displayErrorDetails' => true]]);

$app->get('/', function () use ($container) {
    // Create new Acme\Template instance
    $template = $container->make('template');

    // Render template
    echo $template->render('home');
});

$app->get('/send-email', function () use ($container) {
    // Create new Acme\Mailer instance
    $mailer = $container->make('mailer');

    // Set mail settings
    $mailer->to = 'foo@bar.com';
    $mailer->subject = 'Test email';
    $mailer->body = 'This is a test email.';

    // Send the email
    if ($mailer->send()) {
        echo 'Email successfully sent!';
    }
});

$app->get('/login', function () use ($container) {
    // Create new Acme\Authentication instance
    $auth = $container->make('auth');

    // Validate the user credentials
    if ($auth->verifyLogin('username', 'password')) {
        echo 'User successfully logged in!';
    }
});

$app->get('/articles', function () use ($container) {
    // Create new Acme\Database instance
    $database = $container->make('database');

    // Select all articles from the database
    $articles = $database->select('SELECT * FROM articles ORDER BY title');

    // Display the articles
    foreach ($articles as $article) {
        echo '<a href="#">' . $article['title'] . '</a><br>';
    }
});

// Example of automatic resolution, where the container automatically
// creates an instance of the requested controller, including all
// of its class dependencies
$app->get('/automatic-resolution', [$container->make('Acme\Controller'), 'home']);

// A NotifyUser interface is bound in the container.
// Whenever an implementation is needed
// Illuminate/Container resolves
// the concrete implemention.
$app->get('/interface-to-implementation', function () use ($container) {

    $notification = $container->make('Acme\Contracts\NotifyUser');
    $notification->sendNotification('Somebody hit the url!');
});

$app->get('/persons', function () use ($container) {

    try {
        $controller = $container->make(PersonController::class);

        $persons = $controller->getAll();

        echo '<ul>';
        foreach ($persons as $person) {
            echo "<li>Id: ".$person->id().",    Nome: ".$person->name()."</li>";
        }
        echo '</ul>';

    } catch (\Throwable $th) {
        throw $th;
    }
   
});

$app->get('/persons/{id}', function () use ($container) {

    try {
        $controller = $container->make(PersonController::class);

        $person = $controller->find(2);

        echo '<ul>';

        echo "<li>Id: ".$person->id().",    Nome: ".$person->name()."</li>";
        
        echo '</ul>';

    } catch (\Throwable $th) {
        throw $th;
    }
   
});

$app->run();
