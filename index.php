<?php

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Views\PhpRenderer;
use Src\Controllers\AuthorsController;
use Src\Controllers\BooksController;
use Src\Controllers\HomeController;
use Src\middleware\AuthMiddleware;

require __DIR__ . '/vendor/autoload.php';
session_start();

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();
$container->set(PhpRenderer::class, function() {
    return new PhpRenderer(__DIR__ . '/templates');
} );
ORM::configure('mysql:host=database;dbname=docker');
ORM::configure('username', 'root');
ORM::configure('password', 'tiger');

$app->get('/', function (Request $request, Response $response) {
    return $response->withHeader('Location', '/books')->withStatus(302);
});

//$app->get('/', [HomeController::class, 'index']);

    $app->get('/books', [BooksController::class, 'index']);

    $app->get('/login', [\Src\Controllers\LoginController::class, 'loginPage']);
    $app->get('/auth/register', [\Src\Controllers\RegisterController::class, 'registerPage']);
    $app->post('/auth/register', [\Src\Controllers\RegisterController::class, 'store']);
    $app->post('/auth/login', [\Src\Controllers\LoginController::class, 'login']);
    $app->get('/auth/logout', [\Src\Controllers\LoginController::class, 'logout']);

    $app->group('', function() use ($app) {
        $app->get('/admin/books', [BooksController::class, 'admin']);
        $app->get('/admin/{id}/history', [BooksController::class, 'historyShow']);
        $app->get('/admin/authors', [AuthorsController::class, 'authors']);

        $app->post('/admin/{id}/addAuthor', [AuthorsController::class, 'addAuthor']);
        $app->get('/admin/{id}/delAuthor/{author_id}',[AuthorsController::class, 'delAuthor']);

        $app->get('/admin/{book_id}/createHistory', [BooksController::class, 'createHistory']);
        $app->post('/admin/createHistory', [BooksController::class, 'storeHistory']);
        $app->get('/admin/{id}/deleteHistory',[BooksController::class, 'deleteHistory']);

        $app->get('/admin/createAuthor', [AuthorsController::class, 'createAuthor']);
        $app->post('/admin/createAuthor', [AuthorsController::class, 'storeAuthor']);
        $app->get('/admin/{id}/deleteAuthor',[AuthorsController::class, 'deleteAuthor']);
        $app->get('/admin/authors/{id}', [AuthorsController::class, 'showAuthor']);
        $app->post('/admin/authors/{id}/updateAuthor', [AuthorsController::class, 'updateAuthor']);


        $app->get('/admin/create', [BooksController::class, 'create']);
        $app->post('/admin/create', [BooksController::class, 'store']);
        $app->get('/admin/{id}',[BooksController::class, 'show']);
        $app->post('/admin/{id}/update',[BooksController::class, 'update']);
        $app->get('/admin/{id}/delete',[BooksController::class, 'delete']);

    })
    ->add(new  AuthMiddleware($container->get(ResponseFactory::class)));

$app->run();