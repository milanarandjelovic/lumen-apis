<?php

$app->get('/', function () use ($app) {
    return $app->version();
});

/**  Books routes **/
$app->get('/books', ['as' => 'books.index', 'uses' => 'BooksController@index']);
$app->get('/books/{id:[\d]+}', ['as' => 'books.show', 'uses' => 'BooksController@show']);
$app->post('/books', ['as' => 'books.store', 'uses' => 'BooksController@store']);
$app->put('/books/{id:[\d]+}', ['as' => 'books.update', 'uses' => 'BooksController@update']);
$app->delete('/books/{id:[\d]+}', ['as' => 'books.delete', 'uses' => 'BooksController@destroy']);

/* Authors route */
$app->group(['prefix' => '/author', 'namespace' => 'App\Http\Controllers'], function (\Laravel\Lumen\Application $app) {
    $app->get('/', ['as' => 'author.index', 'uses' => 'AuthorController@index']);
    $app->post('/', ['as' => 'author.store', 'uses' => 'AuthorController@store']);
    $app->get('/{id:[\d]+}', ['as' => 'author.show', 'uses' => 'AuthorController@show']);
    $app->put('/{id:[\d]+}', ['as' => 'author.update', 'uses' => 'AuthorController@update']);
    $app->delete('/{id:[\d]+}', ['as' => 'author.destroy', 'uses' => 'AuthorController@destroy']);
});


/* Bundles routes */
$app->group(['prefix' => '/bundles', 'namespace' => 'App\Http\Controllers'], function (\Laravel\Lumen\Application $app) {
    $app->get('/{id:[\d]+}', ['as' => 'bundles.show', 'uses' => 'BundlesController@show']);
    $app->put('/{bundleId:[\d]+}/books/{bookId:[\d]+}', ['as' => 'bundles.addBook', 'uses' => 'BundlesController@addBook']);
    $app->delete('/{bundleId:[\d]+}/books/{bookId:[\d]+}', ['as' => 'bundles.delete', 'uses' => 'BundlesController@removeBook']);
});
