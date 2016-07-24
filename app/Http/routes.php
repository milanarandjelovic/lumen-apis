<?php

$app->get('/', function () use ($app) {
    return $app->version();
});

/**  Books routes **/
$app->get('/books', ['as' => 'books.index', 'uses' => 'BooksController@index']);
$app->get('/books/{id:[\d]+}', ['as' => 'books.show', 'uses' => 'BooksController@show']);
$app->post('/books', ['as' => 'books.store', 'uses' => 'BooksController@store']);
$app->put('/books/{id:[\d]+}', ['as' => 'books.update', 'uses' => 'BooksController@update']);
$app->delete('/books/{id:[\d]+}',['as' => 'books.delete', 'uses' => 'BooksController@destroy']);