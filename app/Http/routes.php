<?php

$app->get('/', function () use ($app) {
    return $app->version();
});

/**  Books routes **/
$app->get('/books', 'BooksController@index');
$app->get('/books/{id:[\d]+}', 'BooksController@show');
$app->post('/books', 'BooksController@store');