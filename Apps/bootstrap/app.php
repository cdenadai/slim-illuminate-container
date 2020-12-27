<?php

/*
|--------------------------------------------------------------------------
| Bootstrap
|--------------------------------------------------------------------------
*/

// Include project libraries, including a number of mock
// examples of common, real-world services
require_once __DIR__ . '/../../vendor/autoload.php'; 

use App\Http\Controllers\PersonController;
use Domain\Person\Contracts\PersonControllerInterface;
use Domain\Person\Contracts\PersonRepositoryInterface;
use Domain\Person\Contracts\PersonServiceInterface;
use Infra\Persistence\Person\PDOPersonRepository;
use Services\Person\PersonService;

// Create new IoC Container instance
$container = new Illuminate\Container\Container;

// Bind a "template" class to the container
$container->bind('template', 'Acme\Template');

// Bind a "mailer" class to the container
// Use a callback to set additional settings
$container->bind('mailer', function ($container) {
    $mailer = new Acme\Mailer;
    $mailer->username = 'username';
    $mailer->password = 'password';
    $mailer->from = 'foo@bar.com';

    return $mailer;
});

// Bind a shared "database" class to the container
// Use a callback to set additional settings
$container->singleton('database', function ($container) {
    return new Acme\Database('username', 'password', 'host', 'database');
});

// Bind an existing "authentication" class instance to the container
$auth = new Acme\Authentication;
$container->instance('auth', $auth);

// Bind an interface to a given implementation.
$container->bind('Acme\Contracts\NotifyUser', 'Acme\TextMessageNotification');
$container->bind(PersonControllerInterface::class, PersonController::class);
$container->bind(PersonRepositoryInterface::class, PDOPersonRepository::class);
$container->bind(PersonServiceInterface::class, PersonService::class);

return $container;