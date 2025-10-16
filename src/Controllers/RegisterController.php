<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RegisterController extends Controller
{
    public function registerPage(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, 'auth/register.php');
    }

    public function store(
        RequestInterface  $request,
        ResponseInterface $response,
    )
    {
        $login = $request->getParsedBody()['login'];
        $password = $request->getParsedBody()['password'];
        $user = \ORM::forTable(table_name: 'users')->create();
        $user['login'] = $login;
        $user['password'] = $password;
        $user->save();
        return $response->withHeader('Location', '/login')->withStatus(302);
    }

}