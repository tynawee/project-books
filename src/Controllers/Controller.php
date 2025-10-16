<?php

namespace Src\Controllers;

use http\Message;
use Slim\Flash\Messages;
use Slim\Views\PhpRenderer;

class Controller
{
    public function __construct(
        protected PhpRenderer $renderer,
    )
    {

    }
}