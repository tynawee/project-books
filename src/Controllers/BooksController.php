<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BooksController extends Controller
{

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $books = \ORM::forTable('books')->findArray();

        return $this->renderer->render($response, 'books/books.php', [
            'books' => $books,
        ]);
    }

    public function admin(RequestInterface $request, ResponseInterface $response)
    {
        $books = \ORM::forTable('books')->findArray();
        $authors = \ORM::forTable('authors')->findArray();

        $bookAuthors = [];
        foreach ($books as $book) {
            $bookId = $book['id'];
            $bookAuthors[$bookId] = \ORM::forTable('author_book')
                ->where('book_id', $bookId)
                ->join('authors', 'authors.id = author_book.author_id')
                ->findArray();

            // Отладка: Выводим данные о авторах
            if (empty($bookAuthors[$bookId])) {
                error_log("Нет авторов для книги ID: $bookId");
            } else {
                error_log("Авторы для книги ID: $bookId - " . json_encode($bookAuthors[$bookId]));
            }
        }

        return $this->renderer->render($response, "admin/books.php", [
            'books' => $books,
            'bookAuthors' => $bookAuthors,
            'authors' => $authors
        ]);
    }

    public function show(RequestInterface  $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        $book = \ORM::forTable('books')->findOne($id);
        return $this->renderer->render($response, "admin/show.php", [
                'book' => $book,
        ]);
    }

    public function update(RequestInterface  $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        \ORM::forTable('books')->findOne($id)->set([
            'name' => $request->getParsedBody()['name'],
            'available' => $request->getParsedBody()['available'],
        ])->save();
        return $response->withHeader('Location', '/admin/books')->withStatus(302);
    }

    public function create(RequestInterface  $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, 'admin/create.php');
    }
    public function store(
        \Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response)
    {
        $name = $request->getParsedBody()['name'];
        $available = $request->getParsedBody()['available'];

        $book = \ORM::forTable('books')->create();
        $book['name'] = $name;
        $book['available'] = $available;
        $book->save();
        return $response->withHeader('Location', '/admin/books')->withStatus(302);
    }

    public function delete(RequestInterface  $request, ResponseInterface $response, array $args,)
    {
        $id = $args['id'];
        \ORM::forTable('books')->findOne($id)->delete();
        return $response->withHeader('Location', '/admin/books')->withStatus(302);
    }

    public function historyShow(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        $history = \ORM::forTable('history')->where('book_id', $id)->findMany();

        return $this->renderer->render($response, 'admin/history.php', [
            'history' => $history,
            'book_id' => $id
        ]);
    }

    public function createHistory(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $book_id = $args['book_id'];

        return $this->renderer->render($response, 'admin/createHistory.php', [
            'book_id' => $book_id,
        ]);
    }

    public function storeHistory(\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response)
    {
        $data = $request->getParsedBody();
        $user = $data['user'];
        $date_end = $data['date_end'];
        $book_id = $data['book_id'];

        $owner_id = $_SESSION['user_id'];

        $history = \ORM::forTable('history')->create();
        $history['user'] = $user;
        $history['date_begin'] = date('Y-m-d H:i:s');
        $history['date_end'] = $date_end;
        $history['owner_id'] = $owner_id;
        $history['book_id'] = $book_id;

        $history->save();
        return $response->withHeader('Location', '/admin/' . $data['book_id'] . '/history')->withStatus(302);
    }

    public function deleteHistory(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];

        $history = \ORM::forTable('history')->findOne($id);
        $book_id = $history->book_id;
        $history->delete();

        return $response->withHeader('Location', '/admin/' . $book_id . '/history')->withStatus(302);
    }


}