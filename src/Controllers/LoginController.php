<?php

namespace Src\Controllers;

use http\Client\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class LoginController extends Controller
{
    public function loginPage(RequestInterface  $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, 'auth/login.php');
    }

    public function login(RequestInterface  $request, ResponseInterface $response,)
    {
        $login = $request->getParsedBody()['login'];
        $password = $request->getParsedBody()['password'];

        $user = \ORM::forTable('users')->where('login', $login)->findOne();
        if (!$user) {
            echo '<p>Логин неверный <a href="/login">попробовать снова</a></p>';
            exit();
            //return $response->withHeader('Location', '/login')->withStatus(302);
        }
        if ($user['password'] !== $password) {
            echo '<p>Пароль неверный <a href="/login">попробовать снова</a></p>';
            exit();
        }

        $_SESSION['user_id'] = $user['id'];
        $books = \ORM::forTable('books')->findArray();
        if ($user && $user->login === 'adm' && $user->password === 'adm') {
            return $this->renderer->render($response, '/admin/books.php', [
                'books' => $books,
                'available' => $books,
            ]);
        } else {
            return $this->renderer->render($response, '/books/books.php', [
                'books' => $books,
            ]);
        }
    }

    public function logout(RequestInterface $request, ResponseInterface $response)
    {
        unset($_SESSION['user_id']);
        return $response->withHeader('Location', '/login')->withStatus(302);
    }

}