<?php
/** @var \Laravel\Lumen\Routing\Router $router */
/*
|---------------------------------------------------------------------
-----
| Application Routes
|---------------------------------------------------------------------
-----
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get('/', function () use ($router) {
 return $router->app->version();
}); //this will point to your local directory

// unsecure routes 
$router->group(['prefix' => 'api'], function () use ($router) {
 $router->get('/books',['uses' => 'BookController@getBooks']);
});

 // more simple routes
 $router->get('/books', 'BookController@index'); //Get all books
 $router->post('/books', 'BookController@add'); //Create a new book
 $router->get('/books/{id}', 'BookController@show'); //Get the book info based on book id
 $router->put('/books/{id}', 'BookController@update'); //Update a book record based on book id
 //$router->patch('/books/{id}', 'BookController@update'); //update user record
 $router->delete('/books/{id}', 'BookController@delete'); //Delete a book record based on book id
?>