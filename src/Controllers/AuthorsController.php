<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthorsController extends Controller
{
    public function authors(RequestInterface  $request, ResponseInterface $response, array $args)
    {
        $authors = \ORM::forTable('authors')->findArray();
        return $this->renderer->render($response, "admin/authors.php", [
            'authors' => $authors,
        ]);
    }

    public function createAuthor(RequestInterface  $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, 'admin/createAuthor.php');
    }

    public function storeAuthor(
        \Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response)
    {
        $name = $request->getParsedBody()['name'];

        $author = \ORM::forTable('authors')->create();
        $author['name'] = $name;
        $author->save();
        return $response->withHeader('Location', '/admin/authors')->withStatus(302);
    }

    public function deleteAuthor(RequestInterface  $request, ResponseInterface $response, array $args,)
    {
        $id = $args['id'];
        \ORM::forTable('authors')->findOne($id)->delete();
        return $response->withHeader('Location', '/admin/authors')->withStatus(302);
    }

    public function showAuthor(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        $author = \ORM::forTable('authors')->findOne($id);
        return $this->renderer->render($response, "admin/showAuthor.php", [
            'author' => $author,
        ]);
    }

    public function updateAuthor(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        \ORM::forTable('authors')->findOne($id)->set([
            'name' => $request->getParsedBody()['name'],
        ])->save();
        return $response->withHeader('Location', '/admin/authors')->withStatus(302);
    }

    public function addAuthor(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $bookId = $args['id'];

        $parsedBody = $request->getParsedBody();
        if (!isset($parsedBody['author_id'])) {
            return $response->withHeader('Location', '/admin/books')->withStatus(302);
        }

        $authorId = $parsedBody['author_id'];

        $existingRelation = \ORM::forTable('author_book')
            ->where('book_id', $bookId)
            ->where('author_id', $authorId)
            ->findOne();

        if (!$existingRelation) {
            $relation = \ORM::forTable('author_book')->create();
            $relation->book_id = $bookId;
            $relation->author_id = $authorId;
            $relation->save();
        }

        return $response->withHeader('Location', '/admin/books')->withStatus(302);
    }
}