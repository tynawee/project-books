<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{

    public function index(\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response,)
    {
        // $renderer = new PhpRenderer(__DIR__ . '/../../templates');

        $viewData = [
            'name' => 'John',
        ];
        return $this->renderer->render($response, 'home.php', $viewData);
    }

}